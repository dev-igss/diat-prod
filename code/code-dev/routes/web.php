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



//RUTAS DE Autentificacion
Route::get('/','ConnectController@getLogin')->name('login');
Route::get('/inicio_sesion','ConnectController@getLogin')->name('login');
Route::post('/inicio_sesion','ConnectController@postLogin')->name('login');
Route::get('/logout','ConnectController@getLogout')->name('logout');

