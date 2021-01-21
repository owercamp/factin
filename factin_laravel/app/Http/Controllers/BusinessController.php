<?php

namespace App\Http\Controllers;

use App\Models\BusinessTracking;
use App\Models\Location;
use App\Models\Municipalities;
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
            BusinessTracking::create([
                'bt_date' => $this->fu($request->OpDate),
                'bt_social' => $this::upper($request->OpSocial),
                'bt_dep' => trim($request->OpDep),
                'bt_mun' => trim($request->OpMun),
                'bt_adr' => trim($request->OpDir),
                'bt_con' => $this::upper($request->OpCon),
                'bt_pho' => $this->fu($request->OpTel),
                'bt_What' => $this->fu($request->OpWhat),
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
        $departament = Location::all();
        $municipality = Municipalities::all();
        $business = BusinessTracking::select('business_trackings.*','locations.*','municipalities.*')
        ->join('locations','locations.depid','=','business_trackings.bt_dep')
        ->join('municipalities','municipalities.munid','=','business_trackings.bt_mun')->get();
        return view('partials.MarketingPlan.BusinessTracking', compact('business','departament','municipality'));
    }

    function businesstrackingapdate(Request $request)
    {
        $validatecompany = BusinessTracking::where('bt_social',$this::upper($request->OpSocial_Edit))
        ->where('bt_id','!=',trim($request->Opid_Edit))->first();
        if($validatecompany == null)
        {
            $updated = BusinessTracking::find($request->Opid_Edit);
            if($updated != null)
            {
                $updated->bt_date = $this->fu($request->OpDate_Edit);
                $updated->bt_social = $this::upper($request->OpSocial_Edit);
                $updated->bt_dep = trim($request->OpDep_Edit);
                $updated->bt_mun = trim($request->OpMun_Edit);
                $updated->bt_adr = trim($request->OpDir_Edit);
                $updated->bt_con = $this::upper($request->OpCon_Edit);
                $updated->bt_pho = $this->fu($request->OpTel_Edit);
                $updated->bt_What = $this->fu($request->OpWhat_Edit);
                $updated->bt_ema = trim($request->OpEma_Edit);
                $updated->bt_Obs = $this->fu($request->OpObs_Edit);
                $updated->save();
                return redirect()->route('tracking.index')->with('PrimaryCreation','Actualización de '.$this::upper($request->OpSocial_Edit).' exitoso');
            }else{
                return redirect()->route('tracking.index')->with('SecondaryCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('tracking.index')->with('SecondaryCreation','No se pudo actualizar '.$this::upper($request->OpSocial_Edit));
        }
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
