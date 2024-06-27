<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\authController;
use App\Http\Controllers\Api\loginController;
use App\Http\Controllers\Api\usuarioController;


//Login

Route::post('/login', [loginController::class, 'login']);
Route::apiResource('/usuarios', usuarioController::class);

Route::middleware('auth:sanctum')->get('/usuario', [authController::class, 'usuario']);
Route::middleware('auth:sanctum')->post('/logout', [authController::class, 'logout']);

//Api Usuarios

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/usuarios', [usuarioController::class, 'index']);
    Route::post('/usuarios', [usuarioController::class, 'store']);
    Route::get('/usuarios/{id}', [usuarioController::class, 'show']);
    Route::put('/usuarios/{id}', [usuarioController::class, 'update']);
    // Route::patch('/usuarios/{id}', [usuarioController::class, 'updatePartial']);
    Route::delete('/usuarios/{id}', [usuarioController::class, 'destroy']);
});

//Api Credito

// Route::get('/creditos', [creditoController::class, 'index']);
// Route::post('/creditos', [creditoController::class, 'store']);
// Route::get('/creditos/{id}', [creditoController::class, 'show']);
// Route::put('/creditos/{id}', [creditoController::class, 'update']);
// Route::delete('/creditos/{id}', [creditoController::class, 'destroy']);

