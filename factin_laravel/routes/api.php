<?php

use App\Models\icon_name;
use App\Models\Municipalities;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//obtencion de los municipíos apartir de un mdepartamento
Route::get('getMunicipalities',function(Request $request){
    $municipality = Municipalities::where('mundepid',trim($request->DepId))->orderBy('munname','asc')->get();
    return response()->json($municipality);
})->name('getMunicipalities');

