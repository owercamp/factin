<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function businessoportunityindex()
    {
        return view('partials.MarketingPlan.BusinessOpportunity');
    }

    function businesstrackingindex()
    {
        return view('partials.MarketingPlan.BusinessTracking');
    }

    function businessindicatorsindex()
    {
        return view('partials.MarketingPlan.SuccessIndicators');
    }

    function businessarchiveindex()
    {
        return view('partials.MarketingPlan.BusinessArchive');
    }
}
