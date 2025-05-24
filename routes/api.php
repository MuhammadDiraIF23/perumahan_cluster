<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfilController;



Route::apiResource('users', UserController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/profil', [ProfilController::class, 'show']);
Route::get('/profil/{warga_id}', [ProfilController::class, 'getProfile']);
Route::post('/upload-foto', [ProfilController::class, 'uploadFoto']);
Route::post('/upload-ktp', [ProfilController::class, 'uploadKtp']);



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

