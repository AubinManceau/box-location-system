<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $tenants = Tenant::where('user_id', $user_id)->get();
        return view('tenant.index', compact('tenants'));
    }

    public function show($id)
    {

    }

    public function create(Request $request)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
