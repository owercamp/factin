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
use App\Models\TekenCommercial;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class TradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function commercialfileindex()
    {
        $commercial = Lead::select('leads.*','business_trackings.*','locations.*','municipalities.*')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->get();

        return view('partials.PotentialCustomers.CommercialFile', compact('commercial'));
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

    function commercialproposalupdate(Request $request)
    {
        // return $request;
        $validate = Lead::where('lead_social',trim($request->CoSocial))
        ->where('lead_id','!=',trim($request->Coid))
        ->first();
        if ($validate == null) {
            $valida = Lead::find($request->Coid);
            if ($valida != null) {
                $price =$this->fu($request->CoPrice);
                $nonprice = str_replace('.','',$price);
                $sub = $this->fu($request->CoSub);
                $subt = str_replace('.','',$sub);
                $iva = $this->fu($request->CoVIva);
                $viva = str_replace('.','',$iva);
                $total = $this->fu($request->CoTotal);
                $totale = str_replace('.','',$total);
                $valida->lead_Date = $this->fu($request->CoDate);
                $valida->lead_social = trim($request->CoSocial);
                $valida->lead_tide = $this->fu($request->CoTipo);
                $valida->lead_ide = $this->fu($request->CoNumero);
                $valida->lead_dep = trim($request->CoDep);
                $valida->lead_mun = trim($request->CoMun);
                $valida->lead_adr = $this->fu($request->CoDir);
                $valida->lead_con = $this::upper($request->CoCon);
                $valida->lead_pho = $this->fu($request->CoTel);
                $valida->lead_what = $this->fu($request->CoWhat);
                $valida->lead_ema = $this->fu($request->CoEma);
                $valida->lead_obs = $this->fu($request->CoObs);
                $valida->lead_pro = $this::upper($request->CoProHidden);
                $valida->lead_value = $nonprice;
                $valida->lead_quantity = $this->fu($request->CoCan);
                $valida->lead_sub = $subt;
                $valida->lead_porcentage = $this->fu($request->CoIva);
                $valida->lead_iva = $viva;
                $valida->lead_total = $totale;
                $valida->save();
                return redirect()->route('monitoring.index')->with('PrimaryCreation','Almacenado');
            }else{
                return redirect()->route('monitoring.index')->with('SecondaryCreation','NoEncontrado');
            }
        }
    }

    function commercialmonitoringteken(Request $request)
    {
        $NonNull = $request->sid;
        if($NonNull != null){
            TekenCommercial::create([
                'tkc_Date' => trim($request->datelocale),
                'tkc_social' => trim($request->sid),
                'tkc_teken' => trim($request->Bitacora)
            ]);
            return redirect()->route('monitoring.index')->with('SuccessCreation','Bitacora almacenada');
        }else{
            return redirect()->route('monitoring.index')->with('SecondaryCreation','No se pudo almacenar la bitacora');
        }
    }

    function commercialmonitoringapproved(Request $request)
    {
        // return $request;
        $validate = Lead::find($request->bt_id_status);
        if ($validate != null) {
            $name = Lead::find($request->bt_id_status);
            $validate->lead_status = 'APROBADO';
            $validate->save();
            return redirect()->route('monitoring.index')->with('PrimaryCreation','El estado de aprobación se actualizo a aprobado');
        }else{
            return redirect()->route('monitoring.index')->with('SecondCreation','NoEncontrado');
        }
    }

    function commercialmonitoringnonapproved(Request $request)
    {
        // return $request;
        $MyValidate = Lead::find($request->bt_status_denied);
        if ($MyValidate != null) {
            $name = lead::find($request->bt_status_denied);
            $MyValidate->lead_status = 'NO APROBADO';
            $MyValidate->save();
            return redirect()->route('monitoring.index')->with('WarningCreation','Estado de aprobación se actualizo a no aprobado');
        }else{
            return redirect()->route('monitoring.index')->with('SecondCreation','NoEncontrado');
        }
    }

    function commercialindicatorsindex()
    {
        return view('partials.PotentialCustomers.SuccessIndicators');
    }

    function CommercialPDF(Request $request)
    {
        $commercial = Lead::where('lead_id',$request->pdfprint)
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->first();

        $pdf = PDF::loadView('partials.pdf.ArchivePDF', \compact('commercial'));
        return $pdf->stream('Formato.pdf');
    }

    function CommercialstatusPDF(Request $request)
    {
        $commercial = Lead::where('lead_id',$request->pdfprint)
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->first();

        $pdf = PDF::loadView('partials.pdf.ArchivestatusPDF', \compact('commercial'));
        return $pdf->stream('Formato.pdf');
    }
}
