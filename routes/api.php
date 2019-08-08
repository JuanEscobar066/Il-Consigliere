<?php

use Illuminate\Http\Request;
use App\Model\Miembro;
use App\Model\PuntoAgenda;

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


/*Route::get('/example', function() {
    return array('success' => 'me cago en josue');
});*/

Route::get('/getUsers', function() {
    $user = new Miembro();
    return $user->mostrar();
});

Route::get('/getPuntoActivo', function() {
    $punto = new PuntoAgenda();
    return $punto->obtenerPuntoActivo();
});

Route::post('/postUsers', 'Auth\LoginController@check');

Route::post('/postAccept', 'SesionController@favorPuntoApp');
Route::post('/postRefuse', 'SesionController@contraPuntoApp');
Route::post('/postRefrain', 'SesionController@abstenerPuntoApp');

/*Route::get('/<culaquier_nombre>', '<nombre_controlador>@<nombre_funcion>');*/