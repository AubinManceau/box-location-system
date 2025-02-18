<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Box;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index()
    {
        $contracts = Contract::whereHas('box', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->where('date_end', '>=', Carbon::now())->get();

        $bills = Bill::all();
        $date = Carbon::now();
        $date_start = $date->copy()->subMonth()->startOfMonth();
        $date_end = $date->copy()->subMonth()->endOfMonth();

        return view('bill.index', [
            'contracts' => $contracts,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'bills' => $bills,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'payment_amount' => 'required',
            'period_number' => 'required',
            'contract_id' => 'required',
        ]);

        $bill = Bill::create([
            'payment_amount' => $request->payment_amount,
            'period_number' => $request->period_number,
            'contract_id' => $request->contract_id,
        ]);

        return redirect()->route('bill.index');
    }

    public function show($id)
    {
        $bill = Bill::find($id);
        $tenant = Tenant::find($bill->contract->tenant_id);

        $date = Carbon::now();
        $date_start = $date->copy()->subMonth()->startOfMonth();
        $date_end = $date->copy()->subMonth()->endOfMonth();

        return view('bill.show', [
            'bill' => $bill,
            'tenant' => $tenant,
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);
    }
}
