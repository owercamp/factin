<?php

namespace App\Http\Controllers;

use App\Mail\response_to_close;
use App\Mail\response_to_request;
use App\Models\BusinessTracking;
use App\Models\Collaborator;
use App\Models\Following;
use App\Models\Lead;
use App\Models\Request as ModelsRequest;
use App\Models\TekenRequest;
use App\Models\UserClient;
use App\Models\UserRating;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    function requestindex()
    {
        $bt = BusinessTracking::all();        
        $req = UserClient::select('user_clients.*','contracts.*','agreements.*','leads.*','business_trackings.*')
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        return view('partials.Support.Requests',compact('req','bt'));
    }
    // almacena un a nueva solicitud a la tbl teken_requests
    function requestsave(Request $request)
    {
        $validate = ModelsRequest::where('req_cli',trim($request->req_cli))
        ->where('req_user',$this->upper($request->req_user))
        ->where('req_con',intval($request->req_cont))->first();
        if ($validate == null) {
            $numberChar = intval($request->req_cont);
            ModelsRequest::create([
                'req_ide' => $this->fu($request->req_ide),
                'req_cli' => trim($request->req_cli_add),
                'req_user' => $this->upper($request->req_user),
                'req_con' => $this->fu($numberChar),
                'req_sol1' => $this->fu($request->req_sol1),
                'req_sol2' => $this->fu($request->req_sol2),
                'req_sol3' => $this->fu($request->req_sol3),
            ]);
            return redirect()->route('request.index')->with('SuccessCreation','Solicitud del usuario '.$this->upper($request->req_user).' almacenado correctamente');
        }else{
            return redirect()->route('request.index')->with('SecondaryCreation','Solicitud del usuario '.$this->upper($request->req_user).' no pudo ser almacenado');
        }
    }
    // Pasa a la vista de Soporte >> Programación todas las solicitudes programadas.
    function programmingindex()
    {
        $Collaborator = Collaborator::all();
        $req = UserClient::select('user_clients.*','contracts.*','agreements.*','leads.*','business_trackings.*')
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        $soli = ModelsRequest::select('requests.*','user_clients.*','contracts.*','agreements.*','leads.*','business_trackings.*')
        ->join('user_clients','user_clients.id','=','requests.req_cli')
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        return view('partials.Support.Programming',compact('soli','req','Collaborator'));
    }
    // permite la actualizacion de las solicitudes de servicio para soporte tecnico.
    function programmingupdate(Request $request)
    {
        $validate = ModelsRequest::where('req_id','=',trim($request->req_id))->first();
        if ($validate != null) {
            $validate->req_sol1 = $this->fu($request->req_sol1);
            $validate->req_sol2 = $this->fu($request->req_sol2);
            $validate->req_sol3 = $this->fu($request->req_sol3);
            $validate->save();
            return redirect()->route('programming.index')->with('PrimaryCreation','actualización del registro del usuario '.$this->upper($request->req_user).' correcto');
        }else{
            return redirect()->route('programming.index')->with('SecondaryCreation','registro del usuario '.$this->upper($request->req_user).' no pudo ser actualizado');
        }
    }
    // asigna un colaborador al cliente seleccionado.
    function programmingassign(Request $request)
    {
        $col = Collaborator::find($request->assigncol);
        $search = ModelsRequest::find($request->req_id_assign);
        if($search != null)
        {
            $search->req_cola = trim($request->assigncol);
            $search->save();
            return redirect()->route('programming.index')->with('PrimaryCreation','Asignación del colaborador '.$this->upper($col->col_name).' al usuario '.$this->upper($search->req_user).' realizada de manera correcta');
        }else{
            return redirect()->route('Programming.index')->with('SecondaryCreation','Colaborador '.$this->upper($col->col_name).' no pudo ser asignado');
        }
    }
    // envia correo al quiente con la fecha del restablecimiento del servicio adicionalmente genera un caso de solicitud
    function responsetorequest(Request $request)
    {
        // crea registro en la tabla follow de seguimiento
        $register = ModelsRequest::find($request->solid);
        if ($register != null && $register->req_cola  != null) {
            // envio de mensaje al correo del cliente
            $newEmail = new response_to_request($request->soldate);
            Mail::to($request->solemail)->send($newEmail);

            $MyDate = $this->fu($request->soldate);
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
            Following::create([
                'foll_ide' => $register->req_ide,
                'foll_cli' => $register->req_cli,
                'foll_user' => $this->upper($register->req_user),
                'fol_con' => $register->req_con,
                'foll_sol1' => $register->req_sol1,
                'foll_sol2' => $register->req_sol2,
                'foll_sol3' => $register->req_sol3,
                'foll_cola' => $register->req_cola,
                'foll_date' => $MyDates
            ]);
            ModelsRequest::FindOrFail($request->solid)->delete();
            return redirect()->route('programming.index')->with('Correct','SendRequest');
        }else{
            return redirect()->route('programming.index')->with('SecondaryCreation', 'Error al enviar y almacenar la respuesta, debe asignar un colaborador');
        }
    }
    // pasa la consulta de todos mis seguimientos en la vista Soporte >> Seguimiento
    function tracingindex()
    {
        $collaborator = Collaborator::all();
        $follow = Following::select('followings.*','user_clients.*','contracts.*','agreements.*','leads.*','business_trackings.*')
        ->join('user_clients','user_clients.id','=','followings.foll_cli')
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        return view('partials.Support.Tracing', compact('follow','collaborator'));
    }
    // almacena registros en la bitacora de la tbl teken_requests
    function tracingsave(Request $request)
    {
        if ($request != null) {
            $MyDate = $this->fu($request->tkreq_date);
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
            TekenRequest::create([
                'tkreq_follid' => trim($request->tkreq_foll_id),
                'tkreq_date' => $MyDates,
                'tkreq_obs'=> $this->fu($request->tkreq_obs)
            ]);
            return redirect()->route('tracing.index')->with('SuccessCreation','Bitacora del cliente '.$this->upper($request->name).' almacenada correctamente');
        }else{
            return redirect()->route('tracing.index')->with('SecondaryCreation','Error al almacenar la bitacora del cliente '.$this->upper($request->name));
        }
    }
    // cierre de la solicitud modifica la fecha del cierre en la tbl followings
    function tracingclose(Request $request)
    {
        $validate = Following::where('foll_id', trim($request->folls_id))->get();
        if ($validate != null) {
            // actualizacion de fecha del cierre
            $date = date('Y-m-d');
            Following::where('foll_id', trim($request->folls_id))->update(['foll_date_close' => $date]);
            // envia correo al cliente informando el cierre de la solicitud.
            $newEmail = new response_to_close();
            Mail::to($request->foll_email)->send($newEmail);

            return redirect()->route('tracing.index')->with('PrimaryCreation','Cierre de bitacora completo');
        }else{
            return redirect()->route('tracing.index')->with('SecondaryCreation','el cierre de la bitacora no pudo ser ejecutado');
        }
    }
    // Pasa a mi vista Soporte >> Calificación todas las solicitudes que se han cerrado para ser calificadas
    function qualificationindex()
    {
        $collaborator = Collaborator::all();
        $follow = Following::select('followings.*','user_clients.*','contracts.*','agreements.*','leads.*','business_trackings.*')
        ->join('user_clients','user_clients.id','=','followings.foll_cli')
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        return view('partials.Support.Qualification', compact('follow','collaborator'));
    }
    // Pasa la calificacion del cliente a la tbl user_rating(calificacion usuario)
    function qualificationuser(Request $request)
    {
        // return $request;
        $validate = UserRating::where('ur_cli',trim($request->qua_cli))->first();
        if ($validate == null) {
            UserRating::create([
                'ur_cli' => trim($request->qua_cli),
                'ur_user' => $this->upper($request->qua_user),
                'ur_cali' => $this->upper($request->qua_cal),
                'ur_obs' => $request->qua_obs
            ]);
            return redirect()->route('qualification.index')->with('SuccessCreation','Gracias por su calificación');
        }else{
            return redirect()->route('qualification.index')->with('SecondaryCreation','Error no pudo ser calificado el servicio');
        }
    }
    // envio de formulario para la impreción
    function requestprinter(Request $request)
    {
        $register = UserClient::where('id',trim($request->requestprinter))
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();

        $request1 = $request->requestsol1;
        $request2 = $request->requestsol2;
        $request3 = $request->requestsol3;

        $pdf = PDF::loadView('partials.pdf.RequestPDF', compact('register','request1','request2','request3'));
        return $pdf->stream('Solicitud.pdf');
    }
    function archiveindex()
    {
        $collaborator = Collaborator::all();
        $user_rating = UserRating::select('user_ratings.*','followings.*','user_clients.*','contracts.*','agreements.*','leads.*','business_trackings.*')
        ->join('followings','followings.foll_id','=','user_ratings.ur_cli')
        ->join('user_clients','user_clients.id','=','followings.foll_cli')
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        return view('partials.Support.Archive',compact('collaborator','user_rating'));
    }
    function archivePDF(Request $request)
    {
        $alls = UserRating::where('ur_id',trim($request->archivepdf))
        ->join('followings','followings.foll_id','=','user_ratings.ur_cli')
        ->join('collaborators','collaborators.id','=','followings.foll_cola')
        ->join('user_clients','user_clients.id','=','followings.foll_cli')
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();

        $teken = TekenRequest::where('tkreq_follid',trim($request->archivepdf))->get();

        $pdf = PDF::loadView('partials.pdf.ArchivesPDF', compact('alls','teken'));
        return $pdf->stream('Informe.pdf');
    }
    function tracingeditlead(Request $request)
    {
        //se debe editar el registro de la tabla leads
        $soli = UserClient::where('id',trim($request->userClientValue))
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('leads','leads.lead_id','=','agreements.legal_social')->get();
        $val = Lead::find($soli[0]['lead_id']);  
        if ($val != null) {
            $val->lead_social = trim($request->editlead);
            $val->save();
            return redirect()->route('request.index')->with('PrimaryCreation','se ha actualizado el cliente de los registros relacionados');
        }
        
    }
}
