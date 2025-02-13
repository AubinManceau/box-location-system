<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;


class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::where('user_id', Auth::user()->id)->get();
        return view('tenant.index', [
            'tenants' => $tenants,
        ]);
    }

    public function show($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('tenant.show', [
            'tenant' => $tenant,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'adress' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
        ]);
        
        Tenant::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->adress,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tenant.index'); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'adress' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
        ]);

        $tenant = Tenant::findOrFail($id);
        $tenant->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->adress,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
        ]);

        return redirect()->route('tenant.show', $id);
    }

    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $boxes = $tenant->boxes;
        foreach ($boxes as $box) {
            $box->tenant_id = null;
            $box->save();
        }
        $tenant->delete();

        return redirect()->route('tenant.index');
    }
}
