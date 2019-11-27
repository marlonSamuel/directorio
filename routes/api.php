<?php

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

//Route::resource('empleados','Empleado\EmpleadoController');

Route::name('empleados_list')->get('empleados_list', 'Empleado\EmpleadoController@index');
Route::name('users_list')->get('users_list', 'User\UserController@users_list');
