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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('clientes','ClientesController')->middleware('auth');
Route::resource('pedidos','PedidosController')->middleware('auth');

Route::resource('user','UserController')->middleware('auth');
Route::get('getRoleId','UserController@getRoleId')->middleware('auth');
Route::get('getRoles','UserController@getRoles')->middleware('auth');
