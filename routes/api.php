<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\PistaController;
use App\Http\Controllers\PagoController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('reservas', ReservaController::class);
Route::apiResource('pistas', PistaController::class);
//Route::apiResource('pagos', PagoController::class);
