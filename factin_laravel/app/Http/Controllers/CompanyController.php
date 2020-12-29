<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Location;
use App\Models\Municipalities;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function companyinfoindex()
    {
        $company = Company::select(
            'companies.*',
            'locations.*',
            'municipalities.*'
        )
        ->join('locations','locations.depid','locations.depname')
        ->join('municipalities','municipalities.munid','municipalities.munname')
        ->first();
        $location = Location::all();
        $municipality = Municipalities::all();
        return view('partials.Management.information', compact('company','location','municipality'));
    }

    function companyimaindex()
    {
        return view('partials.Management.image');
    }
}
