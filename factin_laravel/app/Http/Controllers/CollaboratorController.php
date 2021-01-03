<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function collaboratorindex()
    {
        return view('partials.HumanResources.collaborators');
    }
}
