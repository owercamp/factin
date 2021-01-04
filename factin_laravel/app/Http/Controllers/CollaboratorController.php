<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Location;
use App\Models\Municipalities;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function collaboratorindex()
    {
        $departament = Location::all();
        $municipality = Municipalities::all();
        $collaborators = Collaborator::select(
            'collaborators.*', 'municipalities.*', 'locations.*'
        )
        ->join('locations','locations.depid','=','collaborators.col_dep')
        ->join('municipalities','municipalities.munid','=','collaborators.col_mun')
        ->get();        
        return view('partials.HumanResources.collaborators', compact('collaborators'));
    }
    function usersclientindex()
    {
        return \view('partials.HumanResources.client_users');
    }
}
