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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usuario', 'User\UserController@index')->name('usuario');
Route::get('/change_password_view', 'User\UserController@changePasswordView')->name('change_password_view');

Route::resource('empleados','Empleado\EmpleadoController');
Route::resource('users','User\UserController');

Route::name('change_password')->post('change_password', 'user\UserController@changePassword');