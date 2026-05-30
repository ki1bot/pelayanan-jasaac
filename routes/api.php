<?php

use App\Http\Controllers\Api\AdminApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\HargaApiController;
use App\Http\Controllers\Api\LaporanApiController;
use App\Http\Controllers\Api\TransaksiApiController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::get('/harga-beli', [HargaApiController::class, 'hargaBeli']);
Route::get('/harga-jual', [HargaApiController::class, 'hargaJual']);
Route::get('/harga-service', [HargaApiController::class, 'hargaService']);

Route::get('/laporan', [LaporanApiController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::post('/beli', [TransaksiApiController::class, 'beli']);
    Route::post('/jual', [TransaksiApiController::class, 'jual']);
    Route::post('/service', [TransaksiApiController::class, 'service']);
});

Route::middleware(['auth:sanctum', 'pemilik'])->prefix('pemilik')->group(function () {
    Route::get('/{jenis}', [AdminApiController::class, 'index']);
    Route::post('/{jenis}', [AdminApiController::class, 'store']);
    Route::put('/{jenis}/{id}', [AdminApiController::class, 'update']);
    Route::delete('/{jenis}/{id}', [AdminApiController::class, 'destroy']);
});
