<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\UserClient;
use Illuminate\Http\Request;

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
        $name = UserClient::where('id',trim($request->req_cli))
        ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
        ->join('agreements','agreements.legal_id','=','contracts.con_id')
        ->join('leads','leads.lead_id','=','agreements.legal_id')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
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
            return redirect()->route('request.index')->with('SuccessCreation','Solicitud del usuario '.$this->upper($name[0]['uc_users']).' almacenado correctamente');
        }else{
            return redirect()->route('request.index')->with('SecondaryCreation','Solicitud del usuario '.$this->upper($name[0]['uc_users']).' no pudo ser almacenado');
        }
    }
    function programmingindex()
    {
        return view('partials.Support.Programming');
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
