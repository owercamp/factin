<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO CREACION DE ROLES (CONFIGURACION)
    =============================================================================================== */

    function accessindex()
    {
        $rol = Role::all();
        return view('partials.Access.access', compact('rol'));
    }
    function accesssave(Request $request)
    {
        $validate = Role::where('name',$this::upper($request->rolename))->first();
        if($validate == null){
            Role::create([
                'name' => $this::upper($request->rolename)
            ]);
            return redirect()->route('access.roles')->with('SuccessCreation','Rol '.$this::upper($request->rolename).' creado ');
        }
    }
    function accessupdate(Request $request)
    {
        $validateData = Role::where('name',$this::upper($request->rolename_Edit))
        ->where('id','!=',trim($request->roleid_Edit))
        ->first();
        if($validateData == null)
        {
            $valida = Role::find($request->roleid_Edit);
            if($valida != null)
            {
                $valida->name = $this::upper($request->rolename_Edit);
                $valida->save();
                return redirect()->route('access.roles')->with('PrimaryCreation','Rol '.$this::upper($request->rolename_Edit).' actualizado');
            }else{
                return redirect()->route('access.roles')->with('SecondaryCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('access.roles')->with('SecondaryCreation','Rol '.$request->rolename_edit.' existente');
        }
    }
    function accessdelete(Request $request)
    {
        $validate = Role::where(trim($request->roleid_Delete));        
        if($validate != null)
        {
            Role::findOrFail($request->roleid_Delete)->delete();
            return redirect()->route('access.roles')->with('WarningCreation','Rol eliminado');
        }else{
            return redirect()->route('access.roles')->with('SecondDelete', 'NoEncontrado');
        }
    }

    /* ===============================================================================================
			MODULO CREACION DE PERMISOS (CONFIGURACION)
    =============================================================================================== */
    
    function permissionindex()
    {
        return view('partials.Access.permission');
    }

    /* ===============================================================================================
			MODULO CREACION DE USUARIOS (CONFIGURACION)
    =============================================================================================== */
    
    function usersindex()
    {
        return view('partials.Access.users');
    }
}
