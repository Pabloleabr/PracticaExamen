<?php

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

Route::get('/', [VuelosController::class, 'index']);

Route::get('login', [UserController::class, 'loginForm']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);

/* rutas para copiar y pegar para el CRUD
Route::get('/alumnos', [AlumnosController::class, 'index']);
Route::get('/alumnos/index', [AlumnosController::class, 'index']);
Route::get('/alumnos/create', [AlumnosController::class, 'create']);
Route::post('/alumnos', [AlumnosController::class, 'store'])
    ->name('alumnos.store');
Route::get('/alumnos/{id}/edit', [AlumnosController::class, 'edit']);
Route::delete('/alumnos/{id}', [AlumnosController::class, 'destroy']);
Route::put('/alumnos/{id}', [AlumnosController::class, 'update'])
    ->name('alumnos.update');
Route::get('/alumnos/criterios/{id}', [AlumnosController::class, 'criterios']);
 */
