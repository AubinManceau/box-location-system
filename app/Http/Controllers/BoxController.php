<?php

namespace App\Http\Controllers;
use App\Models\Box;
use App\Models\Tenant;
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
        return view('box.show', [
            'box' => $box,
            'tenants' => $tenants,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'adress' => 'required',
            'price' => 'required',
            'tenant_id' => 'nullable',
        ]);

        Box::create([
            'name' => $request->name,
            'description' => $request->description,
            'adress' => $request->adress,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
            'tenant_id' => $request->tenant_id,
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
            'tenant_id' => 'nullable',
        ]);

        $box = Box::findOrFail($id);
        $box->update([
            'name' => $request->name,
            'description' => $request->description,
            'adress' => $request->adress,
            'price' => $request->price,
            'tenant_id' => $request->tenant_id,
        ]);

        return redirect()->route('box.show', $id);
    }

    public function destroy($id)
    {
        $box = Box::findOrFail($id);
        $box->delete();

        return redirect()->route('dashboard');
    }
}

