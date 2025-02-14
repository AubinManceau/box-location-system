<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Tenant;
use App\Models\Contract;
use App\Models\ContractModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function index()
    {
        $boxes = Box::where("user_id", Auth::user()->id)->get();
        $tenants = Tenant::where("user_id", Auth::user()->id)->get();
        return view('dashboard', [
            'boxes' => $boxes,
            'tenants' => $tenants,
        ]);
    }

    public function show($id)
    {
        $box = Box::findOrFail($id);
        $tenants = Tenant::where("user_id", Auth::user()->id)->get();
        $contractModels = ContractModel::where("user_id", Auth::user()->id)->get();

        $contract = Contract::where("box_id", $id)
            ->where('date_end', '>=', now()->format('Y-m-d'))
            ->first();
        if($contract){
            $contract_content = $this->generateContract($contract);
        }

        return view('box.show', [
            'box' => $box,
            'tenants' => $tenants,
            'contract' => $contract ?? null,
            'contract_content' => $contract_content ?? null,
            'contractModels' => $contractModels,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'adress' => 'required',
            'price' => 'required',
        ]);

        Box::create([
            'name' => $request->name,
            'description' => $request->description,
            'adress' => $request->adress,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('dashboard');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'adress' => 'required',
            'price' => 'required',
        ]);

        $box = Box::findOrFail($id);
        $box->update([
            'name' => $request->name,
            'description' => $request->description,
            'adress' => $request->adress,
            'price' => $request->price,
        ]);

        return redirect()->route('box.show', $id);
    }

    public function destroy($id)
    {
        $box = Box::findOrFail($id);
        $box->delete();

        return redirect()->route('dashboard');
    }

    private function generateContract($contract) {
        $placeholders = [
            '%user_name%' => $contract->box->user->name,
            '%user_email%' => $contract->box->user->email,
            '%tenant_name%' => $contract->tenant->firstname . ' ' . $contract->tenant->lastname,
            '%tenant_adress%' => $contract->tenant->adress . ' ' . $contract->tenant->city . ' ' . $contract->tenant->zip_code,
            '%tenant_phone%' => $contract->tenant->phone,
            '%tenant_email%' => $contract->tenant->email,
            '%box_adress%' => $contract->box->adress,
            '%box_id%' => $contract->box_id,
            '%contract_date%' => $contract->date_start,
            '%contract_month_time%' => ceil(\Carbon\Carbon::parse($contract->date_start)->diffInMonths(\Carbon\Carbon::parse($contract->date_end))),
            '%contract_rent%' => $contract->price ?? $contract->box->price,
            '&nbsp;' => ' ',
        ];
    
        $contractContentJson = $contract->contractModel->contract_description;
        $decodedContent = json_decode($contractContentJson, true);
        
        foreach ($decodedContent['blocks'] as &$block) {
            if (isset($block['data']['text'])) {
                $block['data']['text'] = strtr($block['data']['text'], $placeholders);
            } else if (isset($block['data']['items'])) {
                foreach ($block['data']['items'] as &$item) {
                    $item = strtr($item['content'], $placeholders);
                }
            }
        }

        return $decodedContent;
    }    
}
