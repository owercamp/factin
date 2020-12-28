<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO CREACION INFORMACION CORPORATIVA (CONFIGURACION)
    =============================================================================================== */

    function companyinfoindex()
    {
        return view('partials.Management.information');
    }


    /* ===============================================================================================
			MODULO CREACION IMAGEN CORPORATIVA (CONFIGURACION)
    =============================================================================================== */

    function companyimaindex()
    {
        return view('partials.Management.image');
    }
}
