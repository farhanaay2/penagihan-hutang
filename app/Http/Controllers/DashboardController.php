<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Debt;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalCustomers'  => Customer::count(),
            'totalDebts'      => Debt::sum('amount'),
            'totalPayments'   => Payment::sum('amount'),
            'totalRemaining'  => max(0, Debt::sum('amount') - Payment::sum('amount')),
        ]);
    }
}
