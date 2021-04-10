<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

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