<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Lead;
use App\Models\Location;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function ClienteLegalization()
    {
        $Departament = Location::all();
        $Client = Agreement::select('agreements.*','leads.*','business_trackings.*','locations.*','municipalities.*')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->get();
        return \view('partials.Agreement.ClientLegalization', \compact('Client','Departament'));
    }

    function ContractLegalization()
    {
        return \view('partials.Agreement.ContractLegalization');
    }

    function ContractsFile()
    {
        return \view('partials.Agreement.ContractsFile');
    }

    function SuccessIndicator()
    {
        return \view('partials.Agreement.SuccessIndicator');
    }

}
