<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContractModel;
use Illuminate\Support\Facades\Auth;

class ContractModelController extends Controller
{
    public function index()
    {
        $contract_models = ContractModel::where('user_id', Auth::user()->id)->get();
        return view('contract_model.index', [
            'contract_models' => $contract_models,
        ]);
    }

    public function show($id)
    {
        $contract_model = ContractModel::findOrFail($id);
        return view('contract_model.show', [
            'contract_model' => $contract_model,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contract_description' => 'required',
        ]);

        ContractModel::create([
            'name' => $request->name,
            'contract_description' => $request->contract_description,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('contract_model.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'contract_description' => 'required',
        ]);

        $contract_model = ContractModel::findOrFail($id);
        $contract_model->update([
            'name' => $request->name,
            'contract_description' => $request->contract_description,
        ]);

        return redirect()->route('contract_model.show', $id);
    }

    public function destroy($id)
    {
        $contract_model = ContractModel::findOrFail($id);
        $contract_model->delete();

        return redirect()->route('contract_model.index');
    }
}
