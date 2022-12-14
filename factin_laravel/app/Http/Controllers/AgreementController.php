<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Collaborator;
use App\Models\Contract;
use App\Models\Lead;
use App\Models\Location;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use PhpParser\Node\Stmt\TryCatch;

class AgreementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function ClienteLegalization()
    {
        $Departament = Location::all();
        $Collaborator = Collaborator::all();
        $ClientActive = Lead::select('leads.*','business_trackings.*')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        $Client = Agreement::select('agreements.*','leads.*','business_trackings.*','locations.*','municipalities.*')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->get();
        return \view('partials.Agreement.ClientLegalization', \compact('Client','Departament','ClientActive','Collaborator'));
    }

    function ClientLegalizationSave(Request $request)
    {
        $comision = $request->ClComi;
        $char = \str_replace('.','',$comision);
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
                'legal_ema' =>$request->ClEma,
                'legal_typeClient' =>$this->upper($request->CltypeCli),
                'legal_typeDocRSocial' =>$this->upper($request->ClDoc),
                'legal_DocRSocial' =>$this->fu($request->ClNumero),
                'legal_repre' =>$this->upper($request->ClRepresentante),
                'legal_typeDocRepre' =>$this->upper($request->ClDocRepre),
                'legal_DocRepre' =>$this->fu($request->ClNumeroRepre),
                'legal_Cola' =>$request->ClCola,
                'legal_comi' => $char
            ]);
                return \redirect()->route('ClientLegalization.index')->with('SuccessCreation','Legalizaci??n del cliente con representante legal '.$this->upper($request->ClRepresentante).' almacenada correctamente');
        }else {
            return \redirect()->route('ClientLegalization.index')->with('SecondaryCreation','legalizaci??n del cliente con representante legal '.$this->upper($request->ClRepresentante).' no pudo ser almacena existe datos duplicados');
        }
    }

    function ClientLegalizationUpdate(Request $request)
    {
        $comision = $request->ClComi_Edit;
        $char = \str_replace('.','',$comision);
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
                $vali->legal_Ema = $request->ClEma_Edit;
                $vali->legal_typeClient = $this->upper($request->CltypeCli_Edit);
                $vali->legal_typeDocRSocial = $this->upper($request->ClDoc_Edit);
                $vali->legal_DocRSocial = trim($request->ClNumero_Edit);
                $vali->legal_repre = $this->upper($request->ClRepresentante_Edit);
                $vali->legal_typeDocRepre = $this->upper($request->ClDocRepre_Edit);
                $vali->legal_DocRepre = trim($request->ClNumeroRepre_Edit);
                $vali->legal_Cola = \trim($request->ClCola_Edit);
                $vali->legal_comi = $char;
                $vali->save();
                return \redirect()->route('ClientLegalization.index')->with('PrimaryCreation', 'Actualizaci??n del registro con representante legal '.$this->upper($request->ClRepresentante_Edit).' se ejecuto correctamente');
            }else{
                return \redirect()->route('ClientLegalization.index')->with('SecondaryCreation', 'Actualizaci??n del registro con representante legal '.$this->upper($request->ClRepresentante_Edit).' no pudo ser ejecutado');
            }
        }else{
            return \redirect()->route('ClientLegalization.index')->with('SecondaryCreation', 'No se encontro registro para actualizar');
        }
    }

    function ClientLegalizationDelete(Request $request)
    {
        // return $request; se debe configurar para la eliminacion
        $validate = Agreement::where(trim($request->LegalCli_Delete));
        if ($validate != null) {
            try {
                Agreement::FindOrFail($request->LegalCli_Delete)->delete();
                return redirect()->route('ClientLegalization.index')->with('WarningCreation','Eliminaci??n Satisfatoria');
            } catch (\Illuminate\Database\QueryException $th) {
                // \dd(\get_class($th));
                return redirect()->route('ClientLegalization.index')->with('SecondaryCreation','No es posible eliminar el cliente ya que cuenta con contratos asociados.');
            }
        }else{
            return redirect()->route('ClientLegalization.index')->with('SecondaryCreation','No es posible la eliminaci??n.');
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
                'con_repre' => $this->upper($request->ClRepre),
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
                $valu->con_typeiderepre = $this->upper($request->ClDoc_Edit);
                $valu->con_repre = $this->upper($request->ClRepre_Edit);
                $valu->con_numero = $this->fu($request->ClTel_Edit);
                $valu->con_ini = $this->fu($request->ClFIni_Edit);
                $valu->con_final = $MyDates;
                $valu->con_price = $price;
                $valu->con_quota = $this->fu($request->ClQuota_Edit);
                $valu->con_valueqouta = $priceq;
                $valu->con_fquota = $this->fu($request->ClFQuota_Edit);
                $valu->save();
                return redirect()->route('ContractLegalization.index')->with('PrimaryCreation','actualizaci??n correctamente');
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
            return redirect()->route('ContractLegalization.index')->with('WarningCreation','Contrato N?? '.$Cont.' ha sido eliminado');
        } else {
            $del = Contract::find(trim($request->LegalCli_Delete));
            $Cont = sprintf("%'.04d\n",$del->conNumber);
            return redirect()->route('ContractLegalization.index')->with('SecondaryCreation','Contrato N?? '.$Cont.' no encontrado');
        }

    }

    function ContractLegalizationPrinter(Request $request)
    {
        $info = Contract::where('con_id',$request->id_printer)
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->get();
        // captura mi fecha de la consulta superior y la modificamos para mostarla entera.
        $dates = $info[0]['con_final'];
        $date = new DateTime($dates);
        $day = $date->format('d');
        $year = $date->format('Y');
        $month = $date->format('m');
        $dayl = $date->format('N');
        switch ($month) {
            case '01': $mon = "enero"; break; case '02': $mon = "febrero"; break; case '03': $mon = "marzo"; break; case '04': $mon = "abril"; break; case '05': $mon = "mayo"; break; case '06': $mon = "junio"; break; case '07': $mon = "julio"; break; case '08': $mon = "agosto"; break; case '09': $mon = "septiembre"; break; case '10': $mon = "octubre"; break; case '11': $mon = "noviembre"; break; case '12': $mon = "diciembre"; break;
        }
        switch ($dayl) {
            case 7: $dayv = 'Domingo'; break; case 1: $dayv = 'Lunes'; break; case 2: $dayv = 'Martes'; break; case 3: $dayv = 'Miercoles'; break; case 4: $dayv = 'Jueves'; break; case 5: $dayv = 'Viernes'; break; case 6: $dayv = 'Sabado'; break;
        }
        $db_date = $dayv.', '.$day.'-'.$mon.'-'.$year;

        $pdf = PDF::loadView('partials.pdf.ContractPDF', compact('info','db_date'));
        return $pdf->stream('Contrato.pdf');
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

    function ContractLegalizationFail(Request $request)
    {
        $fail = Contract::where('con_id',$request->id_fail)
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')
        ->join('locations','locations.depid','=','leads.lead_dep')
        ->join('municipalities','municipalities.munid','=','leads.lead_mun')->get();
        // captura mi fecha de la consulta superior y la modificamos para mostarla entera.
        $dates = $fail[0]['con_final'];
        $date = new DateTime($dates);
        $day = $date->format('d');
        $year = $date->format('Y');
        $month = $date->format('m');
        $dayl = $date->format('N');
        switch ($month) {
            case '01': $mon = "enero"; break; case '02': $mon = "febrero"; break; case '03': $mon = "marzo"; break; case '04': $mon = "abril"; break; case '05': $mon = "mayo"; break; case '06': $mon = "junio"; break; case '07': $mon = "julio"; break; case '08': $mon = "agosto"; break; case '09': $mon = "septiembre"; break; case '10': $mon = "octubre"; break; case '11': $mon = "noviembre"; break; case '12': $mon = "diciembre"; break;
        }
        switch ($dayl) {
            case 7: $dayv = 'Domingo'; break; case 1: $dayv = 'Lunes'; break; case 2: $dayv = 'Martes'; break; case 3: $dayv = 'Miercoles'; break; case 4: $dayv = 'Jueves'; break; case 5: $dayv = 'Viernes'; break; case 6: $dayv = 'Sabado'; break;
        }
        $db_date = $dayv.', '.$day.'-'.$mon.'-'.$year;

        $pdf = PDF::loadView('partials.pdf.ContractFailPDF',compact('fail','db_date'));
        return $pdf->stream('Contrato Vencido.pdf');
    }

    function SuccessIndicator()
    {
        return \view('partials.Agreement.SuccessIndicator');
    }

}
