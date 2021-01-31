<?php

use App\Models\BusinessTracking;
use App\Models\Hardware;
use App\Models\icon_name;
use App\Models\Location;
use App\Models\Municipalities;
use App\Models\Portfolio;
use App\Models\Software;
use App\Models\TechnicalSupport;
use App\Models\Teken;
use Illuminate\Foundation\Console\Presets\React;
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

//obtencion de las bitacoras segun la razón social
Route::get('getTekens',function(Request $request){
    $query = Teken::where('tk_social',trim($request->data))->get();
    return response()->json($query);
})->name('getTekens');

//obtencion del registro apartir de la razon social
Route::get('getCommercial',function(Request $request){
    $query = BusinessTracking::where('bt_id', trim($request->data))->get();
    return response()->json($query);
})->name('getCommercial');

Route::get('getFactin',function(){
    $query = Portfolio::select('portfolios.*', 'product_configs.*', 'products.*')
    ->join('product_configs', 'product_configs.pc_id', '=', 'portfolios.cpro_id')
    ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getFactin');

Route::get('getSoftware',function(){
    $query = Software::select('software.*', 'product_configs.*', 'products.*')
    ->join('product_configs', 'product_configs.pc_id', '=', 'software.cpro_id')
    ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getSoftware');

Route::get('getHardware',function(){
    $query = Hardware::select('hardware.*', 'product_configs.*', 'products.*')
    ->join('product_configs', 'product_configs.pc_id', '=', 'hardware.cpro_id')
    ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getHardware');

Route::get('getSupport',function(){
    $query = TechnicalSupport::select('technical_supports.*', 'product_configs.*', 'products.*')
    ->join('product_configs', 'product_configs.pc_id', '=', 'technical_supports.cpro_id')
    ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getSupport');

Route::get('getFactinPrice',function(Request $request){
    $query = Portfolio::where('por_id',trim($request->data))->get();
    return response()->json($query);
})->name('getFactinPrice');

Route::get('getSoftwarePrice',function(Request $request){
    $query = Software::where('sof_id',trim($request->data))->get();
    return response()->json($query);
})->name('getSoftwarePrice');

Route::get('getHardwarePrice',function(Request $request){
    $query = Hardware::where('har_id',trim($request->data))->get();
    return response()->json($query);
})->name('getHardwarePrice');

Route::get('getSupportPrice',function(Request $request){
    $query = TechnicalSupport::where('id',trim($request->data))->get();
    return response()->json($query);
})->name('getSupportPrice');