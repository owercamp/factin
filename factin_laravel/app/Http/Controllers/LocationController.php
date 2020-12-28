<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Municipalities;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO CREACION DE DEPARTAMENTOS (CONFIGURACION)
    =============================================================================================== */

    function locationindex()
    {
        $departaments = Location::all();
        return view('partials.Location.departament',compact('departaments'));
    }
    function locationsave(Request $request)
    {
        $search = Location::where('depname',$this::upper($request->name))->first();
        if($search == null)
        {
            Location::create([
                'depname' => $this::upper($request->name)                
            ]);
            return redirect()->route('location.located')->with('SuccessCreation', 'Departamento '.$this::upper($request->depname).' creado');
        }else{
            return redirect()->route('location.located')->with('SecondaryCreation','Error al crear el departamento');
        }
    }
    function locationupdate(Request $request)
    {
        $Search = Location::where('depname', $this::upper($request->depname_Edit))
        ->where('depid','!=',$this::upper($request->depid_Edit))
        ->first();
        if($Search == null)
        {
            $updated= Location::find($request->depid_Edit);
            if($updated != null)
            {
                $updated->depname = $this::upper($request->depname_Edit);
                $updated->save();
                return redirect()->route('location.located')->with('PrimaryCreation', 'Departamento '.$this::upper($request->depname_Edit).' actualizado');
            }else{
                return redirect()->route('location.located')->with('SecondaryCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('location.located')->with('SecondaryCreation','Departamento '.$request->depname_edit.' existente');
        }
    }
    function locationdelete(Request $request)
    {
        $Search = Location::where(trim($request->depid_Delete));
        if($Search != null)
        {
            $deleted = $this::upper($request->depname_Delete);
            Location::findOrFail($request->depid_Delete)->delete();
            return redirect()->route('location.located')->with('WarningCreation','Departamento '.$deleted.' eliminado');
        }else{
            return redirect()->route('location.located')->with('SecondDelete', 'NoEncontrado');
        }
    }

    /* ===============================================================================================
			MODULO CREACION DE DEPARTAMENTOS (CONFIGURACION)
    =============================================================================================== */

    function municipalityindex()
    {
        $departments = Location::all();
        $municipality = Municipalities::select('municipalities.*','locations.*')
        ->join('locations','locations.depid','municipalities.mundepid')
        ->get();
        return view('partials.Location.municipality', compact('departments','municipality'));
    }
    function municipalitysave(Request $request)
    {
        $search = Municipalities::where('munname',ucfirst(mb_strtoupper(trim($request->munname),'UTF-8')))
        ->where('mundepid',trim($request->mundepid))
        ->first();
        if($search == null)
        {
            Municipalities::create([
                'munname' => ucfirst(mb_strtoupper(trim($request->munname),'UTF-8')),
                'mundepid' => trim($request->mundepid)
            ]);
            return redirect()->route('municipalities.municipality')->with('SuccessCreation','Municipio ' . ucfirst(mb_strtolower(trim($request->munname),'UTF-8')) . ', registrado');
        }else{
            $department = Location::find(trim($request->mundepid));
            return redirect()->route('municipalities.municipality')->with('SecondaryCreation','El municipio ' . $search->munname . ' ya se encuentra registrado en el departamento ' . $department->depname);
        }
    }
    function municipalityupdate(Request $request){
        $search = Municipalities::where('munname',ucfirst(mb_strtoupper(trim($request->munname_Edit),'UTF-8')))
                                        ->where('mundepid',trim($request->mundepid_Edit))
                                        ->where('munid','!=',trim($request->munid_Edit))
                                        ->first();
        if($search == null){
            $validate = Municipalities::find(trim($request->munid_Edit));
            if($validate != null){
                $validate->munname = ucfirst(mb_strtoupper(trim($request->munname_Edit),'UTF-8'));
                $validate->mundepid = trim($request->mundepid_Edit);
                $validate->save();
                return redirect()->route('municipalities.municipality')->with('PrimaryCreation', 'Municipio ' . ucfirst(mb_strtoupper(trim($request->munname_Edit),'UTF-8')) . ', actualizado');
            }else{
                return redirect()->route('municipalities.municipality')->with('SecondaryCreation', 'No se encuentra el municipio, consulte al administrador');
            }               
        }else{
            return redirect()->route('municipalities.municipality')->with('Secondarycreation', 'Ya existe un municipio con el nombre');
        }
    }
    function municipalitydelete(Request $request)
    {
        $validate = Municipalities::find(trim($request->mundepid_Delete));
        if($validate != null){
            $name = $validate->munname;
            $validate->delete();
            return redirect()->route('municipalities.municipality')->with('WarningCreation', 'Municipio ' . $name . ', eliminado');
        }else{
            return redirect()->route('municipalities.municipality')->with('SecondaryCreation', 'No se encuentra el municipio, Consulte con el administrador');
        }
    }
}
