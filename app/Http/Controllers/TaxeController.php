<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bill;

class TaxeController extends Controller
{
    public function index()
    {
        $year = date('Y');
        $bills = Bill::where('created_at', 'like', $year . '%')
            ->whereHas('contract.box', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->get();
        $annualTurnover = 0;

        foreach ($bills as $bill) {
            if($bill->payment_date){
                $annualTurnover += $bill->payment_amount;
            }
        }

        return view('taxe.index', [
            'annualTurnover' => $annualTurnover,
            'year' => $year
        ]);
    }
}
