<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Location;
use App\Models\Municipalities;
use Illuminate\Http\Request;
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

    function companyimaindex()
    {
        return view('partials.Management.image');
    }
}
