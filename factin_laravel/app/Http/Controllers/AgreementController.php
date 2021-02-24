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
        $Departament = Location::all();
        $legal = Agreement::select('agreements.*','leads.*','business_trackings.*')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        $contract = Contract::select('contracts.*','agreements.*','leads.*','business_trackings.*','locations.*','municipalities.*')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->get();
        return \view('partials.Agreement.ContractLegalization',compact('contract','Departament','legal'));
    }

    function ContractLegalizationSave(Request $request)
    {
        // return $request;
        $validate = Contract::where('conNumber',trim($request->ClContract))
        ->first();
        if($validate == null){
            $MyDate = $this->fu($request->ClFFinal);
            $DateNumber = mb_split(",",$MyDate);
            $Dat = mb_split("-",$DateNumber[1]);
            $Mont = $this->fu($Dat[1]);
            $MyDatesArray = array('01','02','03','04','05','06','07','08','09','10','11','12');
            switch ($Mont) {
                case 'Enero': $mon = $MyDatesArray[0]; break;
                case 'Febrero': $mon = $MyDatesArray[1]; break;
                case 'Marzo': $mon = $MyDatesArray[2]; break;
                case 'Abril': $mon = $MyDatesArray[3]; break;
                case 'Mayo': $mon = $MyDatesArray[4]; break;
                case 'Junio': $mon = $MyDatesArray[5]; break;
                case 'Julio': $mon = $MyDatesArray[6]; break;
                case 'Agosto': $mon = $MyDatesArray[7]; break;
                case 'Septiembre': $mon = $MyDatesArray[8]; break;
                case 'Octubre': $mon = $MyDatesArray[9]; break;
                case 'Noviembre': $mon = $MyDatesArray[10]; break;
                case 'Diciembre': $mon = $MyDatesArray[11]; break;
            }
            $day = $this->fu($Dat[0]); $year = $this->fu($Dat[2]);
            $MyDates = $year.'-'.$mon.'-'.$day;
            $price = str_replace('.','',$request->ClValue);
            $priceq = str_replace('.','',$request->ClQuotaValue);
            Contract::create([
                'conNumber' => trim($request->ClContract),
                'con_social' => trim($request->ClSocial),
                'con_typeiderepre' => $this->fu($request->ClDoc),
                'con_repre' => $this::upper($request->ClRepre),
                'con_numero' => trim($request->ClTel),
                'con_ini' => $this->fu($request->ClFIni),
                'con_final' => $MyDates,
                'con_price' => $price,
                'con_quota' => $this->fu($request->ClQuota),
                'con_valueqouta' => $priceq,
                'con_fquota' => $this->fu($request->ClFQuota),
            ]);
            return redirect()->route('ContractLegalization.index')->with('SuccessCreation','Contrato almacenado');
        }else{
            return redirect()->route('ContractLegalization.index')->with('SecondaryCreation','Contrato no pudo ser almacenado');
        }
    }

    function ContractLegalizationUpdate(Request $request)
    {
        // return $request;
        $validate = Contract::where('conNumber',trim($request->ClContract_Edit))
        ->where('con_id','!=',trim($request->Cl_id_Edit))->first();
        if ($validate == null) {
            $valu = Contract::find($request->Cl_id_Edit);
            if ($valu != null) {
                $price = str_replace('.','',$request->ClValue_Edit);
                $priceq = str_replace('.','',$request->ClQuotaValue_Edit);
                $MyDate = $this->fu($request->ClFFinal_Edit);
                $DateNumber = mb_split(",",$MyDate);
                $Dat = mb_split("-",$DateNumber[1]);
                $Mont = $this->fu($Dat[1]);
                $MyDatesArray = array('01','02','03','04','05','06','07','08','09','10','11','12');
                switch ($Mont) {
                    case 'Enero': $mon = $MyDatesArray[0]; break;
                    case 'Febrero': $mon = $MyDatesArray[1]; break;
                    case 'Marzo': $mon = $MyDatesArray[2]; break;
                    case 'Abril': $mon = $MyDatesArray[3]; break;
                    case 'Mayo': $mon = $MyDatesArray[4]; break;
                    case 'Junio': $mon = $MyDatesArray[5]; break;
                    case 'Julio': $mon = $MyDatesArray[6]; break;
                    case 'Agosto': $mon = $MyDatesArray[7]; break;
                    case 'Septiembre': $mon = $MyDatesArray[8]; break;
                    case 'Octubre': $mon = $MyDatesArray[9]; break;
                    case 'Noviembre': $mon = $MyDatesArray[10]; break;
                    case 'Diciembre': $mon = $MyDatesArray[11]; break;
                }
                $day = $this->fu($Dat[0]); $year = $this->fu($Dat[2]);
                $MyDates = $year.'-'.$mon.'-'.$day;
                $valu->conNumber = $this->fu($request->ClContract_Edit);
                $valu->con_social = $this->fu($request->ClSocial_Edit);
                $valu->con_typeiderepre = $this::upper($request->ClDoc_Edit);
                $valu->con_repre = $this::upper($request->ClRepre_Edit);
                $valu->con_numero = $this->fu($request->ClTel_Edit);
                $valu->con_ini = $this->fu($request->ClFIni_Edit);
                $valu->con_final = $MyDates;
                $valu->con_price = $price;
                $valu->con_quota = $this->fu($request->ClQuota_Edit);
                $valu->con_valueqouta = $priceq;
                $valu->con_fquota = $this->fu($request->ClFQuota_Edit);
                $valu->save();
                return redirect()->route('ContractLegalization.index')->with('PrimaryCreation','actualización correctamente');
            }else{
                return redirect()->route('ContractLegalization.index')->with('SecondaryCreation','error al actualizar');
            }
        }
    }

    function ContractLegalizationDelete(Request $request)
    {
        // return $request;
        $validate = Contract::where(trim($request->LegalCli_Delete));
        if ($validate != null) {
            $del = Contract::find(trim($request->LegalCli_Delete));
            $Cont = sprintf("%'.04d\n",$del->conNumber);
            Contract::findOrFail($request->LegalCli_Delete)->delete();
            return redirect()->route('ContractLegalization.index')->with('WarningCreation','Contrato N° '.$Cont.' ha sido eliminado');
        } else {
            $del = Contract::find(trim($request->LegalCli_Delete));
            $Cont = sprintf("%'.04d\n",$del->conNumber);
            return redirect()->route('ContractLegalization.index')->with('SecondaryCreation','Contrato N° '.$Cont.' no encontrado');
        }

    }

    function ContractsFile()
    {
        $Departament = Location::all();
        $legal = Agreement::select('agreements.*','leads.*','business_trackings.*')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        $contract = Contract::select('contracts.*','agreements.*','leads.*','business_trackings.*','locations.*','municipalities.*')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->get();
        return \view('partials.Agreement.ContractsFile', compact('contract','Departament','legal'));
    }

    function SuccessIndicator()
    {
        return \view('partials.Agreement.SuccessIndicator');
    }

}
