<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AccountstatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function Accountindex()
    {
        return \view('partials.AccountStatus.AccountIndex');
    }
    function accountfact(Request $request)
    {
        $info = Contract::select('contracts.*','agreements.*','leads.*','business_trackings.*','collaborators.*')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('collaborators','collaborators.id','=','agreements.legal_cola')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social') ->get();
        return \redirect()->route('account.index');
    }
}