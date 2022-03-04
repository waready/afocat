<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/afiliaciones', 'PersonaController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/persona', 'PersonaController@index')->name('persona');
    Route::get('/getpersona', 'PersonaController@getPersona')->name('getpersona');
    Route::resource('/allpersona', 'PersonaController');

    Route::get('/empresa', 'EmpresaController@index')->name('empresa');
    Route::get('/getempresa', 'EmpresaController@getEmpresa')->name('getempresa');
    Route::resource('/allempresa', 'EmpresaController');

    /**Afiliados**/
    Route::get('/afiliaciones', 'AfiliacionesController@index')->name('afiliaciones');
    Route::get('/getafiliaciones', 'AfiliacionesController@getAfiliaciones')->name('getafiliaciones');
    Route::resource('/allafiliaciones', 'AfiliacionesController');

    Route::get('/vehiculo', 'VehiculoController@index')->name('vehiculo');
    Route::get('/getvehiculo', 'VehiculoController@getVehiculo')->name('getvehiculo');
    Route::resource('/allvehiculo', 'VehiculoController');


    //busquedas
    Route::post('/buscar-dni','VehiculoController@busqueda');
});Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

