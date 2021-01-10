<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Location;
use App\Models\Municipalities;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function collaboratorindex()
    {
        $departament = Location::all();
        $municipality = Municipalities::all();
        $collaborators = Collaborator::select(
            'collaborators.*', 'municipalities.*', 'locations.*'
        )
        ->join('locations','locations.depid','=','collaborators.col_dep')
        ->join('municipalities','municipalities.munid','=','collaborators.col_mun')
        ->get();        
        return view('partials.HumanResources.collaborators', compact('collaborators','departament'));
    }

    function collaboratorsave(Request $request)
    {
        $validate = Collaborator::where('col_ide',$this->fu($request->col_ide))
        ->where('col_name',$this->fu($request->col_name))
        ->first();
        if ($validate == null)
        {
            if($request->hasFile('col_pho')){
                $filephoto = $request->file('col_pho');
                $photo = time().$filephoto->getClientOriginalName();
                $filephoto->move('public_photo'.'/photo/', $photo);
            }
            if($request->hasFile('col_fir')){
                $filefir = $request->file('col_fir');
                $signature = time().$filefir->getClientOriginalName();
                $filefir->move('public_signature'.'/signature/', $signature);
            }
            $name = $this->fu($request->col_name);
            Collaborator::create([
                'col_name' => $this->fu($request->col_name),
                'col_ide' => $this->fu($request->col_ide),
                'col_dep' => trim($request->col_dep),
                'col_mun' => trim($request->col_mun),
                'col_adr' => $this->fu($request->col_adr),
                'col_ph1' => trim($request->col_ph1),
                'col_ph2' => trim($request->col_ph2),
                'col_ema' => $this->fu($request->col_ema),
                'col_pho' => $photo,
                'col_fir' => $signature
            ]);
            return redirect()->route('collaborator.index')->with('SuccessCreation','Colaborador '.$name.' registrado satisfactoriamente');
        } else {
            return redirect()->route('collaborator.index')->with('SecondaryCreation', 'Colaborador no pudo ser registrado');
        }
        
    }

    function collaboratorupdate(Request $request)
    {
        $colaborator = Collaborator::where('col_name',$this->fu($request->col_name_Edit))
        ->where('id','!=',trim($request->id_Edit))
        ->first();
        if($colaborator == null)
        {
            $validate = Collaborator::find($request->id_Edit);
            if($validate != null)
            {
                $photo = $request->col_pho_Edit2;
                if($request->hasFile('col_pho_Edit')){
                    $filephoto = $request->file('col_pho_Edit');
                    $photo = time().$filephoto->getClientOriginalName();
                    $filephoto->move('public_photo'.'/photo/', $photo);
                }
                $signature = $request->col_fir_Edit2;
                if($request->hasFile('col_fir_Edit')){
                    $filefir = $request->file('col_fir_Edit');
                    $signature = time().$filefir->getClientOriginalName();
                    $filefir->move('public_signature'.'/signature/', $signature);
                }
                $validate->col_name = $this->fu($request->col_name_Edit);
                $validate->col_ide = $this->fu($request->col_ide_Edit);
                $validate->col_dep = trim($request->col_dep_Edit);
                $validate->col_mun = trim($request->col_mun_Edit);
                $validate->col_adr = $this->fu($request->col_adr_Edit);
                $validate->col_ph1 = trim($request->col_ph1_Edit);
                $validate->col_ph2 = trim($request->col_ph2_Edit);
                $validate->col_ema = $this->fu($request->col_ema_Edit);
                $validate->col_pho = $photo;
                $validate->col_fir = $signature;
                $validate->save();
                return redirect()->route('collaborator.index')->with('PrimaryCreation','Colaborador '.$this::upper($request->col_name_Edit).' fue actualizado');
            }else{
                return redirect()->route('collaborator.index')->with('SecondaryCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('collaborator.index')->with('SecondaryCreation','Colaborador '.$this::upper($request->col_name_Edit).' ya esta registrado');
        }
        
    }

    function collaboratordelete(Request $request)
    {
        $validate = Collaborator::find(trim($request->id_Delete));
        if($validate != null)
        {
            $validate->delete();
            return redirect()->route('collaborator.index')->with('WarningCreation','Registro eliminado satisfactoriamente');
        }else{
            return redirect()->route('collaborator.index')->with('SecondaryCreation','No se encontro registro para eliminar');
        }
    }

    function usersclientindex()
    {
        return \view('partials.HumanResources.client_users');
    }
}
