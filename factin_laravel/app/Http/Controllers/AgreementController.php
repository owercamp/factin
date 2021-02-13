<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Lead;
use App\Models\Location;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

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

    function ClientLegalizationSave(Request $request)
    {
        // return $request;
        $validate = Agreement::where('legal_social',\trim($request->ClSocial))
        ->where('legal_repre',$this->fu($request->ClRepresentante))
        ->where('legal_DocRepre',\trim($request->ClNumeroRepre))->first();
        if ($validate == null) {
            Agreement::create([
                'legal_social' =>\trim($request->ClSocial),
                'legal_dep' =>\trim($request->ClDep),
                'legal_mun' =>\trim($request->ClMun),
                'legal_adr' =>$this->fu($request->ClDir),
                'legal_pho' =>$this->fu($request->ClTel),
                'legal_what' =>$this->fu($request->ClWhat),
                'legal_ema' =>$this->fu($request->ClEma),
                'legal_typeClient' =>$this::upper($request->CltypeCli),
                'legal_typeDocRSocial' =>$this->upper($request->ClDoc),
                'legal_DocRSocial' =>$this->fu($request->ClNumero),
                'legal_repre' =>$this::upper($request->ClRepresentante),
                'legal_typeDocRepre' =>$this::upper($request->ClDocRepre),
                'legal_DocRepre' =>$this->fu($request->ClNumeroRepre)
            ]);
                return \redirect()->route('ClientLegalization.index')->with('SuccessCreation','Legalización del cliente con representante legal '.$this::upper($request->ClRepresentante).' almacenada correctamente');
        }else {
            return \redirect()->route('ClientLegalization.index')->with('SecondaryCreation','legalización del cliente con representante legal '.$this::upper($request->ClRepresentante).' no pudo ser almacena existe datos duplicados');
        }
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
