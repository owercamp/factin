<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
Route::get('/', function () {
    return view('auth.login');    
});

//Authentication Routes
Auth::routes();

//Ruta Home
Route::get('/home', 'HomeController@index')->name('home');

//ruta Accesos
Route::get('/access','AccessController@accessindex')->name('access.roles');
route::post('/access/save', 'AccessController@accesssave')->name('access.save');
route::post('/access/update', 'AccessController@accessupdate')->name('access.update');
route::post('/access/delete', 'AccessController@accessdelete')->name('access.delete');

//ruta Permisos
route::get('/permission', 'AccessController@permissionindex')->name('access.permission');

//ruta usuarios
route::get('/users','AccessController@usersindex')->name('access.users');

//ruta Ubicaciones
route::get('/locations', 'LocationController@locationindex')->name('location.located');
route::post('/locations/save', 'LocationController@locationsave')->name('location.save');
route::post('/locations/update', 'LocationController@locationupdate')->name('location.update');
route::post('/locations/delete', 'LocationController@locationdelete')->name('location.delete');
//ruta Permisos
route::get('/municipalities', 'LocationController@municipalityindex')->name('municipalities.municipality');
route::post('/municipalities/save', 'LocationController@municipalitysave')->name('municipalities.save');
route::post('/municipalities/update', 'LocationController@municipalityupdate')->name('municipalities.update');
route::post('/municipalities/delete', 'LocationController@municipalitydelete')->name('municipalities.delete');
//ruta información coporativa
route::get('/corporate-information', 'CompanyController@companyinfoindex')->name('company.information');
route::post('/corporate-information/save', 'CompanyController@companyinfosave')->name('company.save');
route::post('/corporate-information/update', 'CompanyController@companyinfosave')->name('company.update');
route::post('/corporate-information/delete', 'CompanyController@companyinfodelete')->name('company.delete');
//ruta imagen coporativa
route::get('/corporate-image', 'CompanyController@companyimaindex')->name('company.image');