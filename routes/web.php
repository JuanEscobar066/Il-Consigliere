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
//Route::get('/AnnadirUsuario','UserController@view page');

// Route::get('/', function () {
//     return view('welcome');
// });

/*
Para explicarles, cada una de las rutas del proyecto, está aquí.
Entonces, por ejemplo:

* Il-Consigliere/fotos/

No es que exista una carpeta que se llame fotos dentro del proyecto, en cambio, debería de existir un código
que sea algo así:

Route::get('fotos', function(){
    return view('fotos');
});

Donde, en la carpeta resources/views, existirá un archivo que se llame fotos.blade.php. No es necesario ponerle
blade.php, el asume que es un archivo así.
*/

Route::get('/', function () {
// Redirect::to('/miembro/show');
    return Redirect::to('/home');
});


Route::get('/annadirMiembro', function () {
    return view('AnnadirMiembro');
});

Route::get('/eliminarMiembro', function () {
    return view('EliminarMiembro');
});

Route::get('/administrarAusencias',
	['as'=> 'administrarAusencias', 'uses'=>'AusenciaController@administrarAusencias']
);

Route::get('miembro/update/{parameter}',
        ['as'=> 'update', 'uses'=>'MiembroController@edit']
);

Route::get('delete/{parameter}',
        ['as'=> 'deleteButton', 'uses'=>'MiembroController@deleteButton']
);


Route::get('perfil/edit','MiembroController@perfilUsuario');
Route::post('perfil/update', 'MiembroController@perfilAlmacenar');
Route::get('/sesion/create/{fecha}', ['as'=>'crearSesionConFecha', 'uses'=>'SesionController@crearConFecha']);
Route::get('perfil/correo/delete/{correo}', ['as'=>'eliminarCorreo', 'uses'=>'MiembroController@eliminarCorreo']);

Route::post('ausenciaActualizar', 'AusenciaController@update');


Route::get('ausencia/Aceptar/{ausencia}', ['as'=>'aceptarAusencia', 'uses'=>'AusenciaController@ausenciaAceptar']);
Route::get('ausencia/Rechazar/{ausencia}', ['as'=>'rechazarAusencia', 'uses'=>'AusenciaController@ausenciaRechazar']);


Route::post('sesion/iniciar/{evento}/asistencia', 'SesionController@actualizarAsistencia');



Route::get('enviarPuntos/{parameter}', ['as'=>'enviarPuntos', 'uses'=>'SesionController@enviarPuntos']);

Route::get('sesion/iniciar/{sesion}', ['as'=>'iniciarSesion', 'uses'=>'SesionController@iniciarSesion']);
Route::get('sesion/cerrar/{sesion}', ['as'=>'cerrarSesion', 'uses'=>'SesionController@cerrarSesion']);

Route::get('sesion/iniciar/{sesion}/anterior', ['as'=>'anteriorPunto', 'uses'=>'SesionController@anteriorPunto']);

Route::get('sesion/iniciar/{sesion}/siguiente', ['as'=>'siguientePunto', 'uses'=>'SesionController@siguientePunto']);

Route::get('sesion/iniciar/favor/publico/{sesion}', ['as'=>'favorPunto', 'uses'=>'SesionController@favorPunto']);
Route::get('sesion/iniciar/contra/publico/{sesion}', ['as'=>'contraPunto', 'uses'=>'SesionController@contraPunto']);
Route::get('sesion/iniciar/abstenerse/publico/{sesion}', ['as'=>'abstenerPunto', 'uses'=>'SesionController@abstenerPunto']);

Route::get('sesion/iniciar/favor/privado/{sesion}', ['as'=>'favorPuntoPrivado', 'uses'=>'SesionController@favorPuntoPrivado']);
Route::get('sesion/iniciar/contra/privado/{sesion}', ['as'=>'contraPuntoPrivado', 'uses'=>'SesionController@contraPuntoPrivado']);
Route::get('sesion/iniciar/abstenerse/privado/{sesion}', ['as'=>'abstenerPuntoPrivado', 'uses'=>'SesionController@abstenerPuntoPrivado']);


Route::get('sesion/iniciar/votacion/iniciar/{sesion}', ['as'=>'iniciarvotacion', 'uses'=>'SesionController@iniciarVotacion']);
Route::get('sesion/iniciar/votacion/cerrar/{sesion}', ['as'=>'cerrarvotacion', 'uses'=>'SesionController@cerrarVotacion']);
Route::get('sesion/iniciar/votacion/reiniciar/{sesion}', ['as'=>'reiniciarvotacion', 'uses'=>'SesionController@reiniciarVotacion']);

Route::get('sesion/obtenerPuntosUsuario/{sesion}', ['as'=>'obtenerPuntosUsuario', 'uses'=>'PuntoAgendaController@solicitudPuntos']);
Route::get('sesion/firmarPuntosUsuario/{sesion}', ['as'=>'firmarPuntosUsuario', 'uses'=>'PuntoAgendaController@firmaSolicitudPuntos']);
Route::get('sesion/obtenerPuntos/{sesion}', ['as'=>'obtenerPuntos', 'uses'=>'PuntoAgendaController@crearActa']);

Route::get('sesion/documentoSolicitudPuntos/{sesion}', ['as'=>'documentoSolicitudPuntos', 'uses'=>'PuntoAgendaController@crearDocSolicitudPuntos']);
Route::get('sesion/documentoActa/{sesion}', ['as'=>'documentoActa', 'uses'=>'PuntoAgendaController@crearDocumentoActa']);
Route::get('sesion/firmarActaConsejo/{sesion}', ['as'=>'firmarActa', 'uses'=>'PuntoAgendaController@firmarActaDeConsejo']);

Route::resource('sesion', 'SesionController');
Route::resource('puntoAgenda','PuntoAgendaController');
Route::resource('miembro', 'MiembroController');
Route::resource('ausencias', 'AusenciaController');

Route::get('puntoAgenda/download/{ruta}', 'PuntoAgendaController@download')->name('downloadFile')->where('ruta','.*');
Route::get('indexAdmin','PuntoAgendaController@indexAdmin');
Route::get('indexAdmin/{punto}/accept','PuntoAgendaController@accept');
Route::get('indexAdmin/{punto}/deny','PuntoAgendaController@deny');
Route::get('/acta', function () {return view('puntoAgenda.acta');});
Route::get('/solicitud_puntos', function () {return view('puntoAgenda.solicitud_puntos');});
//Route::name('pdf')->get('/crearPDF', 'PuntoAgendaController@crearActa');
//Route::name('pdf')->get('/crearPDFSolicitud', 'PuntoAgendaController@crearSolicitudPuntos');
Route::name('doc')->get('/descargar', 'PuntoAgendaController@download');

//Route::get('miembroVisualizar', 'MiembroController@show');
//Route::get('miembroCrear', 'MiembroController@create');
Route::get('miembroEliminar', 'MiembroController@delete');
Route::post('miembroInsertarDatos', 'MiembroController@store');
//Route::post('miembroActualizar', 'MiembroController@edit');
Route::post('miembroEliminarDatos', 'MiembroController@deleteData');
Route::post('miembroActualizarDatos', 'MiembroController@update');
Route::get('logOut','Auth\LoginController@logOut');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('events', 'SesionController@index');


// Ruta del login como tal, el .blade.
Route::get('form', function(){
    return View::make('login');
});

// La ruta de la función de login con firma digital.
Route::any('login/firmaDigital', ['as'=>'firmaDigital', 'uses'=>'Auth\LoginController@loginFirmaDigital']);

// Aquí se supone que se agrega el web service en las rutas para ser aceptado.
Route::post('/js/FirmaDigital/componente.js', ['middleware' => 'cors',function(){

    return ['status'=>'success'];
}]);


Route::group(['middleware' => 'cors'], function() {
    Route::post('/js/FirmaDigital/componente.js', function () {
        return ['status'=>'success'];
    });
});

Route::group(['middleware' => 'cors'], function() {
    Route::post('/js/FirmaDigital/componente.js','LoginController@loginFirmaDigital');

});




