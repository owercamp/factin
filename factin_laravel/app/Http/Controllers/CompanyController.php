<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Icon;
use App\Models\Location;
use App\Models\Municipalities;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
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
        return view('partials.Management.image', compact('urls'));
    }
}
