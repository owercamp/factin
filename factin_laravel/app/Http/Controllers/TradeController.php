<?php

namespace App\Http\Controllers;

use App\Models\BusinessTracking;
use App\Models\Hardware;
use App\Models\Location;
use App\Models\Municipalities;
use App\Models\Portfolio;
use App\Models\Software;
use App\Models\TechnicalSupport;
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

    function commercialproposalindex(Request $request)
    {
        // $factin = Portfolio::all(); $hardware = Hardware::all(); $software = Software::all(); $support = TechnicalSupport::all();
        $Departament = Location::all(); $Municipality = Municipalities::all();
        $MyData = BusinessTracking::select('locations.*','municipalities.*','business_trackings.*')
        ->join('locations','locations.depid','=','business_trackings.bt_dep')
        ->join('municipalities','municipalities.munid','=','business_trackings.bt_mun')->get();
        // return $support;
    return view('partials.PotentialCustomers.CommercialProposal', compact('MyData','Departament','Municipality'));
    }

    function commercialindicatorsindex()
    {
        return view('partials.PotentialCustomers.SuccessIndicators');
    }
}
