<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Box;

class ContractController extends Controller
{
    public function create(Request $request){
        $box_id = $request->box_id;

        $request->validate([
            'box_id' => 'required',
            'contract_month_time' => 'required',
            'contract_date' => 'required',
            'tenant_id' => 'required',
            'contract_model_id' => 'required',
        ]);

        $contract = Contract::create([
            'contract_month_time' => $request->contract_month_time,
            'contract_date' => $request->contract_date,
            'tenant_id' => $request->tenant_id,
            'contract_model_id' => $request->contract_model_id,
        ]);

        $box = Box::findOrFail($box_id);
        $box->update([
            'contract_id' => $contract->id,
        ]);

        return redirect()->route('box.show', $box_id);
    }

    public function update(Request $request, $id){
        $request->validate([
            'box_id' => 'required',
            'contract_month_time' => 'required',
            'contract_date' => 'required',
            'tenant_id' => 'required',
            'contract_model_id' => 'required',
        ]);

        $contract = Contract::findOrFail($id);
        $contract->update([
            'box_id' => $request->box_id,
            'contract_month_time' => $request->contract_month_time,
            'contract_date' => $request->contract_date,
            'tenant_id' => $request->tenant_id,
            'contract_model_id' => $request->contract_model_id,
        ]);

        return redirect()->route('box.show', $request->box_id);
    }

    public function destroy(Request $request, $id){
        $request->validate([
            'contract_id' => 'required',
        ]);
        
        $box = Box::findOrFail($id);
        $box->update([
            'contract_id' => null,
        ]);

        $contract = Contract::findOrFail($request->contract_id);
        $contract->delete();


        return redirect()->route('box.show', $request->box_id);
    }
    
}
