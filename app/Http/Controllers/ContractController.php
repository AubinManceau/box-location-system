<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function create(Request $request){
        $box_id = $request->box_id;

        $request->validate([
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

        $box = Box::findOrFail($id);

        $tenants = Tenant::where('user_id', Auth::user()->id)->get();
        $contractModels = ContractModel::where('user_id', Auth::user()->id)->get();

        return redirect()->route('box.show', [
            'tenants' => $tenants,
            'contractModels' => $contractModels,
        ]);
    }

    public function delete($id){

    }
}
