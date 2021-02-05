<?php

namespace App\Http\Controllers;

use App\Models\BusinessTracking;
use App\Models\Hardware;
use App\Models\Lead;
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
        $departament = Location::all();
        $commercial = Lead::select('leads.*','business_trackings.*','locations.*','municipalities.*')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->get();
        // return $commercial;
        return view('partials.PotentialCustomers.CommercialMonitoring', compact('commercial','departament'));
    }

    function commercialproposalindex(Request $request)
    {
        $Departament = Location::all(); $Municipality = Municipalities::all();
        $MyData = BusinessTracking::select('locations.*','municipalities.*','business_trackings.*')
        ->join('locations','locations.depid','=','business_trackings.bt_dep')
        ->join('municipalities','municipalities.munid','=','business_trackings.bt_mun')->get();
    return view('partials.PotentialCustomers.CommercialProposal', compact('MyData','Departament','Municipality'));
    }

    function commercialproposalsave(Request $request)
    {
        // return $request;
        $validate = Lead::where('lead_social',trim($request->CoSocial))
        ->where('lead_con',$this->fu($request->CoCon))
        ->where('lead_obs',$this->fu($request->CoObs))
        ->first();
        if ($validate == null) {
            $price =$this->fu($request->CoPrice);
            $nonprice = str_replace('.','',$price);
            $sub = $this->fu($request->CoSub);
            $subt = str_replace('.','',$sub);
            $iva = $this->fu($request->CoVIva);
            $viva = str_replace('.','',$iva);
            $total = $this->fu($request->CoTotal);
            $totale = str_replace('.','',$total);
            Lead::create([
                'lead_Date' => $this->fu($request->CoDate),
                'lead_social' => trim($request->CoSocial),
                'lead_tide' => $this->fu($request->CoTipo),
                'lead_ide' => $this->fu($request->CoNumero),
                'lead_dep' => trim($request->CoDep),
                'lead_mun' => trim($request->CoMun),
                'lead_adr' => $this->fu($request->CoDir),
                'lead_con' => $this::upper($request->CoCon),
                'lead_pho' => $this->fu($request->CoTel),
                'lead_what' => $this->fu($request->CoWhat),
                'lead_ema' => $this->fu($request->CoEma),
                'lead_obs' => $this->fu($request->CoObs),
                'lead_pro' => $this::upper($request->CoProHidden),
                'lead_value' => $nonprice,
                'lead_quantity' => $this->fu($request->CoCan),
                'lead_sub' => $subt,
                'lead_porcentage' => $this->fu($request->CoIva),
                'lead_iva' => $viva,
                'lead_total' => $totale
            ]);
            return redirect()->route('proposal.index')->with('SuccessCreation','Almacenado');
        }else{
            return redirect()->route('proposal.index')->with('SecondCreation','NoEncontrado');
        }

    }

    function commercialindicatorsindex()
    {
        return view('partials.PotentialCustomers.SuccessIndicators');
    }
}
