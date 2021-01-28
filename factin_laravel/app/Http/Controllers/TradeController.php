<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function commercialfileindex()
    {
        return view('partials.PotentialCustomers.CommercialFile');
    }

    function commercialmonitoringindex()
    {
        return view('partials.PotentialCustomers.CommercialMonitoring');
    }

    function commercialproposalindex()
    {
        return view('partials.PotentialCustomers.CommercialProposal');
    }

    function commercialindicatorsindex()
    {
        return view('partials.PotentialCustomers.SuccessIndicators');
    }
}
