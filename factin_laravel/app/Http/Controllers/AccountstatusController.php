<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountstatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function Accountindex()
    {
        return \view('partials.AccountStatus.AccountIndex');
    }
}
