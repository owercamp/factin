<?php

namespace App\Http\Controllers;

use App\Models\BusinessTracking;
use App\Models\Location;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function businessoportunityindex()
    {
        $departament = Location::all();
        return view('partials.MarketingPlan.BusinessOpportunity', compact('departament'));
    }

    function businessoportunitynew(Request $request)
    {
        $validate = BusinessTracking::where('bt_social',$this::upper($request->OpSocial))
        ->where('bt_con',$this::upper($request->OpCon))->first();
        if($validate == null){
            $phone = $this->fu($request->OpTel);
            $clearObj = array("(",")","-"," ");
            $myphone = str_replace($clearObj,'',$phone);
            $whatsapp = $this->fu($request->OpWhat);
            $clearObjW = array("(",")","-"," ");
            $mywhatsapp = str_replace($clearObjW,'',$whatsapp);            
            BusinessTracking::create([
                'bt_date' => $this->fu($request->OpDate),
                'bt_social' => $this::upper($request->OpSocial),
                'bt_dep' => trim($request->OpDep),
                'bt_mun' => trim($request->OpMun),
                'bt_adr' => trim($request->OpDir),
                'bt_con' => $this::upper($request->OpCon),
                'bt_pho' => $myphone,
                'bt_What' => $mywhatsapp,
                'bt_ema' => trim($request->OpEma),
                'bt_Obs' => $this->fu($request->OpObs)
            ]);
            return redirect()->route('oportunity.index')->with('SuccessCreation','Almacenado');
        }else{
            return redirect()->route('oportunity.index')->with('SecondaryCreation','NoEncontrado');
        }        
    }

    function businesstrackingindex()
    {
        $business = BusinessTracking::select('business_trackings.*','locations.*','municipalities.*')
        ->join('locations','locations.depid','=','business_trackings.bt_dep')
        ->join('municipalities','municipalities.munid','=','business_trackings.bt_mun')->get();
        
        return view('partials.MarketingPlan.BusinessTracking', compact('business'));
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
