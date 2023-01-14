<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

$path = 'App\\Http\\Controllers\\';

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

//User
Route::post('/login', $path . 'UserController@Login'); //Login
Route::post('/user', $path . 'UserController@Create'); //Create
Route::get('/user', $path . 'UserController@ReadAll'); //Read
Route::get('/user{role}', $path . 'UserController@Read'); //Read By Role
Route::post('/user/{id}', $path . 'UserController@Update'); //Update
Route::delete('/user/{id}', $path . 'UserController@Delete'); //Delete
Route::get('/user/{id}', $path . 'UserController@Search'); //Search

//Driver
Route::get('/driver', $path . 'DriverController@Read'); //Read
Route::delete('/driver/{id}', $path . 'DriverController@Delete'); //Delete
Route::get('/driver/{id}', $path . 'DriverController@Search'); //Search

//Armada
Route::post('/armada', $path . 'ArmadaController@Create'); //Create
Route::get('/armada', $path . 'ArmadaController@Read'); //Read
Route::post('/armada/{id}', $path . 'ArmadaController@Update'); //Update
Route::delete('/armada/{id}', $path . 'ArmadaController@Delete'); //Delete
Route::get('/armada/{id}', $path . 'ArmadaController@Search'); //Search

//Bengkel
Route::post('/bengkel', $path . 'BengkelController@Create'); //Create
Route::get('/bengkel', $path . 'BengkelController@Read'); //Read
Route::post('/bengkel/{id}', $path . 'BengkelController@Update'); //Update
Route::delete('/bengkel/{id}', $path . 'BengkelController@Delete'); //Delete
Route::get('/bengkel/{id}', $path . 'BengkelController@Search'); //Search

//Kios BBM
Route::post('/kios_bbm', $path . 'KiosBBMController@Create'); //Create
Route::get('/kios_bbm', $path . 'KiosBBMController@Read'); //Read
Route::post('/kios_bbm/{id}', $path . 'KiosBBMController@Update'); //Update
Route::delete('/kios_bbm/{id}', $path . 'KiosBBMController@Delete'); //Delete
Route::get('/kios_bbm/{id}', $path . 'KiosBBMController@Search'); //Search

//Order
Route::post('/order', $path . 'OrderController@Create'); //Create
Route::get('/order', $path . 'OrderController@Read'); //Read
Route::post('/order/{id}', $path . 'OrderController@Update'); //Update
Route::delete('/order/{id}', $path . 'OrderController@Delete'); //Delete
Route::get('/order/{id}', $path . 'OrderController@Search'); //Search

//Toko Sparepart
Route::post('/toko_sparepart', $path . 'TokoSparepartController@Create'); //Create
Route::get('/toko_sparepart', $path . 'TokoSparepartController@Read'); //Read
Route::post('/toko_sparepart/{id}', $path . 'TokoSparepartController@Update'); //Update
Route::delete('/toko_sparepart/{id}', $path . 'TokoSparepartController@Delete'); //Delete
Route::get('/toko_sparepart/{id}', $path . 'TokoSparepartController@Search'); //Search

//Ulasan
Route::post('/ulasan', $path . 'UlasanController@Create'); //Create
Route::get('/ulasan', $path . 'UlasanController@Read'); //Read
Route::post('/ulasan/{id}', $path . 'UlasanController@Update'); //Update
Route::delete('/ulasan/{id}', $path . 'UlasanController@Delete'); //Delete
Route::get('/ulasan/{id}', $path . 'UlasanController@Search'); //Search

//Trayek
Route::post('/trayek', $path . 'TrayekController@Create'); //Create
Route::get('/trayek', $path . 'TrayekController@Read'); //Read
Route::post('/trayek/{id}', $path . 'TrayekController@Update'); //Update
Route::delete('/trayek/{id}', $path . 'TrayekController@Delete'); //Delete
Route::get('/trayek/{id}', $path . 'TrayekController@Search'); //Search

//Sparepart
Route::post('/sparepart', $path . 'SparepartController@Create'); //Create
Route::get('/sparepart', $path . 'SparepartController@Read'); //Read
Route::post('/sparepart/{id}', $path . 'SparepartController@Update'); //Update
Route::delete('/sparepart/{id}', $path . 'SparepartController@Delete'); //Delete
Route::get('/sparepart/{id}', $path . 'SparepartController@Search'); //Search

//JualBeli
Route::post('/jual_beli', $path . 'JualBeliController@Create'); //Create
Route::get('/jual_beli', $path . 'JualBeliController@Read'); //Read
Route::post('/jual_beli/{id}', $path . 'JualBeliController@Update'); //Update
Route::delete('/jual_beli/{id}', $path . 'JualBeliController@Delete'); //Delete
Route::get('/jual_beli/{id}', $path . 'JualBeliController@Search'); //Search