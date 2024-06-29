<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\loginController;


use App\Http\Controllers\authController;
use App\Http\Controllers\usuarioController;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);

;

//Api Credito

// Route::get('/creditos', [creditoController::class, 'index']);
// Route::post('/creditos', [creditoController::class, 'store']);
// Route::get('/creditos/{id}', [creditoController::class, 'show']);
// Route::put('/creditos/{id}', [creditoController::class, 'update']);
// Route::delete('/creditos/{id}', [creditoController::class, 'destroy']);

