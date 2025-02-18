<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

class TaxeController extends Controller
{
    public function index()
    {
        $year = date('Y');
        $bills = Bill::where('created_at', 'like', $year . '%')->get();
        $annualTurnover = 0;

        foreach ($bills as $bill) {
            $annualTurnover += $bill->payment_amount;
        }

        return view('taxe.index', [
            'annualTurnover' => $annualTurnover,
            'year' => $year
        ]);
    }
}
