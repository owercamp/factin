<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function ClienteLegalization()
    {
        return \view('partials.Agreement.ClientLegalization');
    }

    function ContractLegalization()
    {
        return \view('partials.Agreement.ContractLegalization');
    }

    function ContractsFile()
    {
        return \view('partials.Agreement.ContractsFile');
    }

    function SuccessIndicator()
    {
        return \view('partials.Agreement.SuccessIndicator');
    }

}
