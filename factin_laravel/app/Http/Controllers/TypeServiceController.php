<?php

namespace App\Http\Controllers;

use App\Models\TypeService;
use Illuminate\Http\Request;

class TypeServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function typeserviceindex()
    {
        $service = TypeService::all();
        return view('partials.TypeServices.service', compact('service'));
    }

    function typeservicesave(Request $request)
    {
        $validate = TypeService::where('ts_name',$this->fu($request->ts_name))->first();
        if($validate == null)
        {
            TypeService::create([
                $newservices = $request->service_name,
                'ts_name' => $this->fu($request->service_name)
            ]);
                return redirect()->route('services.index')->with('SuccessCreation', 'Producto '.$newservices.' creado satisfactoriamente');
        }else{
            return redirect()->route('services.index')->with('SecondaryCreation', 'Producto '.$this->fu($request->service_name).' existente');
        }
    }

    function typeserviceupdate(Request $request)
    {
        $validateData = TypeService::where('ts_name',$this->fu($request->service_name_Edit))
        ->where('ts_id','!=',trim($request->serviceid_Edit))
        ->first();
        if($validateData == null)
        {
            $valida = TypeService::find($request->serviceid_Edit);
            if($valida != null)
            {
                $valida->ts_name = $this->fu($request->service_name_Edit);
                $valida->save();
                return redirect()->route('services.index')->with('PrimaryCreation','Servicio '.$this::upper($request->service_name_Edit).' actualizado');
            }else{
                return redirect()->route('services.index')->with('SecondaryCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('services.index')->with('SecondaryCreation','Servicio '.$request->service_name_edit.' existente');
        }
    }

    function typeservicedelete(Request $request)
    {
        $validate = TypeService::where(trim($request->serviceid_Delete));        
        if($validate != null)
        {
            $name = $this->fu($request->service_name_Delete);
            TypeService::findOrFail($request->serviceid_Delete)->delete();
            return redirect()->route('services.index')->with('WarningCreation','Producto '.$name.' eliminado');
        }else{
            return redirect()->route('services.index')->with('SecondDelete', 'NoEncontrado');
        }
    }
}
