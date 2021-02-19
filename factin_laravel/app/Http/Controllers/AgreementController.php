<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Contract;
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

    function ClientLegalizationUpdate(Request $request)
    {
        // return $request;
        $validate = Agreement::where('legal_repre',trim($request->ClRepresentante_Edit))
        ->where('legal_id','!=',trim($request->id_Edit))
        ->first();
        if ($validate == null) {
            $vali = Agreement::find($request->id_Edit);
            if ($vali != null) {
                $vali->legal_id = \trim($request->id_Edit);
                $vali->legal_social = \trim($request->ClSocial_Edit);
                $vali->legal_dep = \trim($request->ClDep_Edit);
                $vali->legal_mun = \trim($request->ClMun_Edit);
                $vali->legal_adr = $this->fu($request->ClDir_Edit);
                $vali->legal_pho = $this->fu($request->ClTel_Edit);
                $vali->legal_what = $this->fu($request->ClWhat_Edit);
                $vali->legal_Ema = $this->fu($request->ClEma_Edit);
                $vali->legal_typeClient = $this::upper($request->CltypeCli_Edit);
                $vali->legal_typeDocRSocial = $this::upper($request->ClDoc_Edit);
                $vali->legal_DocRSocial = trim($request->ClNumero_Edit);
                $vali->legal_repre = $this::upper($request->ClRepresentante_Edit);
                $vali->legal_typeDocRepre = $this::upper($request->ClDocRepre_Edit);
                $vali->legal_DocRepre = trim($request->ClNumeroRepre_Edit);
                $vali->save();
                return \redirect()->route('ClientLegalization.index')->with('PrimaryCreation', 'Actualización del registro con representante legal '.$this::upper($request->ClRepresentante_Edit).' se ejecuto correctamente');
            }else{
                return \redirect()->route('ClientLegalization.index')->with('SecondaryCreation', 'Actualización del registro con representante legal '.$this::upper($request->ClRepresentante_Edit).' no pudo ser ejecutado');
            }
        }else{
            return \redirect()->route('ClientLegalization.index')->with('SecondaryCreation', 'No se encontro registro para actualizar');
        }
    }

    function ClientLegalizationDelete(Request $request)
    {
        // return $request;
        $validate = Agreement::where(trim($request->LegalCli_Delete));
        if ($validate != null) {
            Agreement::findOrFail($request->LegalCli_Delete)->delete();
            return redirect()->route('ClientLegalization.index')->with('WarningCreation','Eliminación Satisfatoria');
        }else{
            return redirect()->route('ClientLegalization.index')->with('SecondCreation','NoEncontrado');
        }
    }

    function ContractLegalization()
    {
        $contract = Contract::select('contracts.*','agreements.*','leads.*','business_trackings.*','locations.*','municipalities.*')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->get();
        return \view('partials.Agreement.ContractLegalization',compact('contract'));
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
