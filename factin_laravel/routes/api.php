<?php

use App\Models\Agreement;
use App\Models\BusinessTracking;
use App\Models\Collaborator;
use App\Models\Contract;
use App\Models\Following;
use App\Models\Hardware;
use App\Models\icon_name;
use App\Models\Lead;
use App\Models\Location;
use App\Models\Municipalities;
use App\Models\Portfolio;
use App\Models\Software;
use App\Models\TechnicalSupport;
use App\Models\Teken;
use App\Models\TekenCommercial;
use App\Models\TekenRequest;
use App\Models\UserClient;
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

//obtencion de las bitacoras segun la razón social tabla business-trackings
Route::get('getTekens',function(Request $request){
    $query = Teken::where('tk_social',trim($request->data))->get();
    return response()->json($query);
})->name('getTekens');

//obtencion de las bitacoras segun la razón social tabla business-trackings
Route::get('getTekensCommercial',function(Request $request){
    $query = TekenCommercial::where('tkc_social',trim($request->data))->get();
    return response()->json($query);
})->name('getTekensCommercial');

//obtencion del registro apartir de la razon social
Route::get('getCommercial',function(Request $request){
    $query = BusinessTracking::where('bt_id', trim($request->data))->get();
    return response()->json($query);
})->name('getCommercial');

// consulta de productos factin formulario oportunidad commercial
Route::get('getFactin',function(){
    $query = Portfolio::select('portfolios.*', 'product_configs.*', 'products.*')
    ->join('product_configs', 'product_configs.pc_id', '=', 'portfolios.cpro_id')
    ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getFactin');

// consulta de productos software formulario oportunidad commercial
Route::get('getSoftware',function(){
    $query = Software::select('software.*', 'product_configs.*', 'products.*')
    ->join('product_configs', 'product_configs.pc_id', '=', 'software.cpro_id')
    ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getSoftware');

// consulta de productos hardware formulario oportunidad commercial
Route::get('getHardware',function(){
    $query = Hardware::select('hardware.*', 'product_configs.*', 'products.*')
    ->join('product_configs', 'product_configs.pc_id', '=', 'hardware.cpro_id')
    ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getHardware');

// consulta de productos soprte tecnico formulario oportunidad commercial
Route::get('getSupport',function(){
    $query = TechnicalSupport::select('technical_supports.*', 'product_configs.*', 'products.*')
    ->join('product_configs', 'product_configs.pc_id', '=', 'technical_supports.cpro_id')
    ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getSupport');

// consulta del precios del producto factin formulario oportunidad commercial
Route::get('getFactinPrice',function(Request $request){
    $query = Portfolio::where('por_id',trim($request->data))
    ->join('product_configs','product_configs.pc_id','=','portfolios.cpro_id')
    ->join('products','products.pro_id','=','product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getFactinPrice');

// consulta del precios del producto software formulario oportunidad commercial
Route::get('getSoftwarePrice',function(Request $request){
    $query = Software::where('sof_id',trim($request->data))
    ->join('product_configs','product_configs.pc_id','=','software.cpro_id')
    ->join('products','products.pro_id','=','product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getSoftwarePrice');

// consulta del precios del producto hardware formulario oportunidad commercial
Route::get('getHardwarePrice',function(Request $request){
    $query = Hardware::where('har_id',trim($request->data))
    ->join('product_configs','product_configs.pc_id','=','hardware.cpro_id')
    ->join('products','products.pro_id','=','product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getHardwarePrice');

// consulta del precios del producto soporte tecnico formulario oportunidad commercial
Route::get('getSupportPrice',function(Request $request){
    $query = TechnicalSupport::where('id',trim($request->data))
    ->join('product_configs','product_configs.pc_id','=','technical_supports.cpro_id')
    ->join('products','products.pro_id','=','product_configs.pc_typepro')->get();
    return response()->json($query);
})->name('getSupportPrice');

// consulta la razon social para el formulario de edicion de oprtunidad commercial
Route::get('getRazonSocial',function(Request $request){
    $query = Lead::where('lead_social',trim($request->data))
    ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
    return response()->json($query);
})->name('getRazonSocial');

// consulta la razon social activa para el formulario de edicion de oprtunidad commercial
Route::get('getRazonSocialActive',function(Request $request){
    $query = Lead::where('lead_id',trim($request->data))
    ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
    return response()->json($query);
})->name('getRazonSocialActive');

// consulta el departament
Route::get('getDepartament',function(Request $request){
    $query = Location::where('depid',trim($request->data))->get();
    return response()->json($query);
})->name('getDepartament');

// consulta el ultimo contrato
Route::get('getContract',function(){
    $query = Contract::latest()->get();
    return response()->json($query);
})->name('getContract');

// consulta el nombre de la razon social para el formulario de eliminacion
Route::get('getLegalContract',function(Request $request){
    $query = Agreement::where('legal_id',trim($request->data))
    ->join('leads','leads.lead_id','=','agreements.legal_id')
    ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
    return response()->json($query);
})->name('getLegalContract');

// consulta para realizar la actualizacion de los contratos
Route::get('getLegalContractUpdate',function(Request $request){
    $query = Contract::where('con_id',trim($request->data))
    ->join('agreements','agreements.legal_id','=','contracts.con_social')
    ->join('leads','leads.lead_id','=','agreements.legal_id')
    ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
    return response()->json($query);
})->name('getLegalContractUpdate');

// realiza la consulta para realiza la eliminacion
Route::get('getRazonSocial',function(Request $request){
    $query = UserClient::where('id',trim($request->data))
    ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
    ->join('agreements','agreements.legal_id','=','contracts.con_id')
    ->join('leads','leads.lead_id','=','agreements.legal_id')
    ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
    return response()->json($query);
})->name('getRazonSocial');

// realiza la consulta por el numero de identificacion en las solicitudes
Route::get('getUserIdentity',function(Request $request){
    $query = UserClient::where('uc_ide',trim($request->data))
    ->join('contracts','contracts.con_id','=','user_clients.uc_cli')
    ->join('agreements','agreements.legal_id','=','contracts.con_id')
    ->join('leads','leads.lead_id','=','agreements.legal_id')
    ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
    return response()->json($query);
})->name('getUserIdentity');

Route::get('getFollow',function(Request $request){
    $query = TekenRequest::where('tkreq_follid',trim($request->data))
    ->join('followings','followings.foll_id','teken_requests.tkreq_follid')
    ->join('user_clients','user_clients.id','=','followings.foll_cli')
    ->join('contracts','contracts.con_id','=','user_clients.id')
    ->join('agreements','agreements.legal_id','=','contracts.con_id')
    ->join('leads','leads.lead_id','=','agreements.legal_id')
    ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
    return response()->json($query);
})->name('getFollow');

