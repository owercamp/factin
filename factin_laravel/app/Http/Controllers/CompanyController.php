<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Icon;
use App\Models\icon_name;
use App\Models\Location;
use App\Models\Municipalities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function companyinfoindex()
    {
        $departament = Location::all();
        $municipality = Municipalities::all();
        $company = Company::select(
            'companies.*',
            'locations.*',
            'municipalities.*'
        )
        ->join('locations','locations.depid','=','companies.comdepid')
        ->join('municipalities','municipalities.munid','=','companies.communid')
        ->first();
        
        return view('partials.Management.information', compact('company','departament','municipality'));
    }
    function companyinfosave(Request $request)
    {
        $validate = Company::where('comsocial',$this->fu($request->comSocial))
        ->where('comnit',$this->fu($request->comNit))
        ->first();
        if($validate == null)
        {
            Company::create([
                'comsocial'=> $this->fu($request->comSocial),
                'comnit' => $this->fu($request->comNit),
                'comdepid' => trim($request->comDepid),
                'communid' => trim($request->comMunid),
                'comaddress' => $this->lower($request->comAddress),
                'comphone1' => trim($request->comPhone1),
                'comphone2' => trim($request->comPhone2),
                'comemail' => $this->lower($request->comEmail),
            ]);
            return redirect()->route('company.information')->with('SuccessCreation','Información almacenada');
        }else{
            return redirect()->route('company.information')->with('SecondaryCreation','la información ya existe');
        }
    }
    function companyinfodelete(Request $request)
    {
        $validation = Company::find(trim($request->comid_Delete));
        if($validation != null)
        {
            $validation->delete();
            return redirect()->route('company.information')->with('WarningCreation','Información corporativa eliminada');
        }else{
            return redirect()->route('company.information')->with('SecondaryCreation','Información corporativa no encontrada');
        }
    }

    function companyimaindex()
    {
        $urls = Icon::all();
        $Logos = icon_name::all();
        return view('partials.Management.image', compact('urls','Logos'));
    }
    function companyimasave(Request $request)
    {
        $validation = Icon::where('ico_qr',trim($request->url))
        ->where('ico_name',trim($request->images))
        ->first();
        if($validation == null)
        {
            if($request->hasFile('avatar')){
                $file =$request->file('avatar');
                $name = time().$file->getClientOriginalName();
                $file->move('public_images'.'/images/', $name);
            }
            icon_name::create([
                'icon_name' => $name
            ]);
            Icon::create([
                'ico_qr' => trim($request->url),
                'ico_name' => $name 
            ]);
                return redirect()->route('company.image')->with('SuccessCreation', 'Imagenes corporativas creadas');
        }else{
            return redirect()->route('company.image')->with('SecondaryCreation', 'no se pudo almacenar');
        }
    }
    function companyimaupdatecode(Request $request)
    {
        $search = Icon::where('ico_qr', $this::lower($request->url_Edit))
        ->where('ico_id','!=',$this::lower($request->icon_id_Edit))
        ->first();
        if ($search == null) {
            $updated = Icon::find($request->icon_id_Edit);
            if ($updated != null) {
                $urls = $updated->ico_qr;
                $updated->ico_qr = $request->url_Edit;
                $updated->save();
                return Redirect()->route('company.image')->with('PrimaryCreation', 'Dirección '.$urls.' del codigo QR fue actualizo');
            } else {
                return Redirect()->route('company.image')->with('SecondaryCreation','Error en la actualización');
            }
        } else {
            return redirect()->route('company.image')->with('SecondaryCreation','codigo no Encontrado');
        }        
    }
    function companyimaupdateimage(Request $request)
    {
        $new_name = $request->Logo_name;
        $validate = Icon::find(trim($request->icon_id_Edit));
        if ($validate != null) {
            $validate->ico_name = $new_name;
            $validate->save();
            return Redirect()->route('company.image')->with('PrimaryCreation', 'Logo actualizo');
        }else{
            return Redirect()->route('company.image')->with('SecondaryCreation','Error en la actualización');
        }
    }
    function companyimadelete(Request $request)
    {
        $validation = Icon::find(trim($request->ico_id_Delete));
        if($validation != null)
        {
            $validation->delete();
            return redirect()->route('company.image')->with('WarningCreation','Información corporativa eliminada');
        }else{
            return redirect()->route('company.image')->with('SecondaryCreation','Información corporativa no encontrada');
        }
    }
}
