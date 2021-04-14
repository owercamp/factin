<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function billingorderindex()
    {
        return \view('partials.Finances.BillingOrder');
    }
}
