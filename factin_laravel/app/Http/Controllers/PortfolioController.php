<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function factinwebindex()
    {
        return view('partials.Portfolio.FactinWeb');
    }

    function softwareindex()
    {
        return view('partials.Portfolio.Software');
    }

    function hardwareindex()
    {
        return view('partials.Portfolio.Hardware');
    }

    function technicalsupportindex()
    {
        return view('partials.Portfolio.TechnicalSupport');
    }
}
