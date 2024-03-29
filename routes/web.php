<?php

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
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

Route::get('/hola', function () {
    // $message =70932833;
    // $url = 'https://api.apis.net.pe/v1/dni?numero='.$message;

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_POST, 0);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // $response = curl_exec ($ch);
    // $err = curl_error($ch);  //if you need
    // curl_close ($ch);

    // return dd($response);
    $token = '';
    $number = 70932833;
    $tipe= "dni";//"ruc"
    $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

    $parameters = [
        'http_errors' => false,
        'connect_timeout' => 5,
        'headers' => [
            'Authorization' => 'Bearer '.$token,
            'User-Agent' => 'laravel/guzzle',
            'Accept' => 'application/json',
        ],
        'query' => ['numero' => $number]
    ];
    $res = $client->request('GET', '/v1/'.$tipe, $parameters);
    $response = json_decode($res->getBody()->getContents(), true);
    return($response);
});

Auth::routes(['register' => false]);
// Ruta de inicio de sesión
/* Authentication Routes... */
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');
  
// // /* Registration Routes... */
// // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// // Route::post('register', 'Auth\RegisterController@register');
  
// /* Password Reset Routes... */
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
  
// /* Email Verification Routes... */
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


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
    Route::get('/afiliaciones', 'AfiliadosController@index')->name('afiliaciones');
    Route::get('/getafiliaciones', 'AfiliadosController@getAfiliaciones')->name('getafiliaciones');
    Route::resource('/allafiliaciones', 'AfiliadosController');

    /**vehiculo**/
    Route::get('/vehiculo', 'VehiculoController@index')->name('vehiculo');
    Route::get('/getvehiculo', 'VehiculoController@getVehiculo')->name('getvehiculo');
    Route::resource('/allvehiculo', 'VehiculoController');

    /**Productos**/
    Route::get('/producto', 'ProductoController@index')->name('producto');
    Route::get('/getproducto', 'ProductoController@getProducto')->name('getproducto');
    Route::resource('/allproducto', 'ProductoController');

    /**Afocats**/
    Route::get('/afocat', 'AfocatController@index')->name('afocat');
    Route::get('/getafocat', 'AfocatController@getafocat')->name('getafocat');
    Route::get('/new-afocat', 'AfocatController@create')->name('new-afocat');
    Route::resource('/allafocat', 'AfocatController');

    /**Ventas**/
    Route::get('/pago', 'PagoController@index')->name('pago');
    Route::get('/getpagos', 'PagoController@getpago')->name('getpagos');
    //busquedas
    Route::post('/buscar-persona','AfiliadosController@busquedaPersona');
    Route::post('/buscar-empresa','AfiliadosController@busquedaEmpresa');
    
    Route::post('/buscar-dni','VehiculoController@busqueda');
    Route::post('/buscar-afiliado','AfocatController@busqueda');



    Route::get('/ventas/{hash}', 'PagoController@imprimirVenta');
    Route::get('certificado-generico','PagoController@generarDocumentoPdf');

    /****SINIESTROS*****/
    //accidentes
    Route::get('/accidente', 'AccidenteController@index')->name('accidente');
    Route::get('/getaccidente', 'AccidenteController@getAccidente')->name('getaccidente');
    Route::resource('/allaccidente', 'AccidenteController');
    
    //accidentado
    Route::get('/accidentado', 'AccidentadoController@index')->name('accidentado');
    Route::get('/getaccidentado', 'AccidentadoController@getAccidentado')->name('getaccidentado');
    Route::resource('/allaccidentado', 'AccidentadoController');

    //accidentes-gastos
    Route::get('/accidente-gastos', 'AccidentadoGastoController@index')->name('accidente-gastos');
    Route::get('/getaccidentegastos', 'AccidentadoGastoController@getaccidente')->name('getaccidentegastos');
    Route::resource('/allaccidente-gastos', 'AccidentadoGastoController');


});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/reporte-afiliados',function () {
    return view('reportes.ReporteAfiliado');
})->name('reporte-afiliados');

Route::get('/reporte-siniestros',function () {
    return view('reportes.ReporteSiniestros');
})->name('reporte-siniestros');

Route::get('/reporte-contable',function () {
    return view('reportes.ReporteContable');
})->name('reporte-contable');

Route::post('/reporte-afiliado-diario', 'ReportController@exportDiario')->name('reporte-afiliado-diario');
Route::post('/reporte-afiliado-mensual', 'ReportController@exportMensual')->name('reporte-afiliado-mensual');
Route::post('/reporte-afiliado-anual', 'ReportController@exportAnual')->name('reporte-afiliado-anual');
Route::get('/getSiniestrosPagados', 'ReportController@siniestrosPagados')->name('getSiniestrosPagados');
Route::get('/getSiniestrosporPagar', 'ReportController@siniestrosporPagar')->name('getSiniestrosporPagar');
Route::post('/reporte-contable-diario', 'ReportController@exportContableDiario')->name('reporte-contable-diario');
Route::post('/reporte-contable-mensual', 'ReportController@exportContableMensual')->name('reporte-contable-mensual');
Route::post('/reporte-contable-anual', 'ReportController@exportContableAnual')->name('reporte-contable-anual');