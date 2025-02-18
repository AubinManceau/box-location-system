<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $bills = Bill::where('payment_date', null)
        ->whereHas('contract.box', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })
        ->get();
        return view('payment.index', [
            'bills' => $bills
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_date' => 'required',
        ]);
        
        $bill = Bill::findOrFail($id);
        $bill->update([
            'payment_date' => $request->payment_date,
        ]);


        return redirect()->route('payment.index');
    }
}
