<?php

namespace App\Http\Controllers;

use App\Mail\response_to_request;
use App\Models\Collaborator;
use App\Models\Request as ModelsRequest;
use App\Models\UserClient;
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
        $req = UserClient::select('user_clients.*','contracts.*','agreements.*','leads.*','business_trackings.*')
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_id')
        ->join('leads','leads.lead_id','=','agreements.legal_id')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        return view('partials.Support.Requests',compact('req'));
    }
    function requestsave(Request $request)
    {
        $validate = ModelsRequest::where('req_cli',trim($request->req_cli))
        ->where('req_user',$this->upper($request->req_user))
        ->where('req_con',intval($request->req_cont))->first();
        if ($validate == null) {
            $numberChar = intval($request->req_cont);
            ModelsRequest::create([
                'req_ide' => $this->fu($request->req_ide),
                'req_cli' => trim($request->req_cli),
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
    function programmingindex()
    {
        $Collaborator = Collaborator::all();
        $req = UserClient::select('user_clients.*','contracts.*','agreements.*','leads.*','business_trackings.*')
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_id')
        ->join('leads','leads.lead_id','=','agreements.legal_id')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        $soli = ModelsRequest::select('requests.*','user_clients.*','contracts.*','agreements.*','leads.*','business_trackings.*')
        ->join('user_clients','user_clients.id','=','requests.req_cli')
        ->join('contracts','contracts.con_id','=','user_clients.id')
        ->join('agreements','agreements.legal_id','=','contracts.con_id')
        ->join('leads','leads.lead_id','=','agreements.legal_id')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        return view('partials.Support.Programming',compact('soli','req','Collaborator'));
    }
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
    function programmingassign(Request $request)
    {
        // return $request;
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
    function responsetorequest(Request $request)
    {
        $newEmail = new response_to_request($request->soldate);
        Mail::to($request->solemail)->send($newEmail);
        return redirect()->route('programming.index');
    }
    function tracingindex()
    {
        return view('partials.Support.Tracing');
    }
    function qualificationindex()
    {
        return view('partials.Support.Qualification');
    }
    function archiveindex()
    {
        return view('partials.Support.Archive');
    }
}
