<?php

namespace App\Http\Controllers;

use App\Models\BillingOrder;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function billingorderindex()
    {
        $billingOrder = BillingOrder::all();
        return \view('partials.Finances.BillingOrder', \compact('billingOrder'));
    }
}
