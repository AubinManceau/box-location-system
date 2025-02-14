<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Box;

class ContractController extends Controller
{
    public function index($id){
        $contracts = Contract::where("box_id", $id)->get();
        $box = Box::findOrFail($id);
        return view('contract.index', [
            'contracts' => $contracts,
            'box' => $box,
        ]);
    }

    public function create(Request $request){
        $request->validate([
            'box_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'price' => 'nullable',
            'tenant_id' => 'required',
            'contract_model_id' => 'required',
        ]);

        $contract = Contract::create([
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'price' => $request->price,
            'box_id' => $request->box_id,
            'tenant_id' => $request->tenant_id,
            'contract_model_id' => $request->contract_model_id,
        ]);

        return redirect()->route('box.show', $request->box_id);
    }

    public function update(Request $request, $id){
        $request->validate([
            'box_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'price' => 'nullable',
            'tenant_id' => 'required',
            'contract_model_id' => 'required',
        ]);

        $contract = Contract::findOrFail($id);
        $contract->update([
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'price' => $request->price,
            'box_id' => $request->box_id,
            'tenant_id' => $request->tenant_id,
            'contract_model_id' => $request->contract_model_id,
        ]);

        return redirect()->route('box.show', $request->box_id);
    }

    public function destroy(Request $request, $id){
        $request->validate([
            'contract_id' => 'required',
        ]);

        $contract = Contract::findOrFail($request->contract_id);
        $contract->delete();


        return redirect()->route('box.show', $id);
    }
}
