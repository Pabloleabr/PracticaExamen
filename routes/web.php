<?php

use App\Http\Controllers\ReservasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VuelosController;
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

Route::get('login', [UserController::class, 'loginForm']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);

Route::get('vuelos', [VuelosController::class, 'index']);

Route::get('reservas', [ReservasController::class, 'reservas']);
Route::get('reservas/{id}', [ReservasController::class, 'show']);
Route::post('vuelos/{id}', [ReservasController::class, 'reservar']);


