<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Cliente;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TipocuentaController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [UserController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('clientes', [ClienteController::class, 'index']);
    Route::get('clientes/{id}', [ClienteController::class, 'show']);
    Route::post('clientes', [ClienteController::class, 'store']);
    Route::put('clientes/{id}', [ClienteController::class, 'update']);
    Route::patch('clientes/{id}', [ClienteController::class, 'update']);
    Route::delete('clientes/{id}', [ClienteController::class, 'destroy']);
});

Route::get('tipocuentas', [TipocuentaController::class, 'index']);
Route::get('tipocuentas/{id}',[TipocuentaController::class, 'show']);
Route::post('tipocuentas', [TipocuentaController::class, 'store']);
Route::put('tipocuentas/{id}', [TipocuentaController::class, 'update']);
Route::patch('tipocuentas/{id}', [TipocuentaController::class, 'update']);
Route::delete('tipocuentas/{id}', [TipocuentaController::class, 'destroy']);

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}',[UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::patch('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);