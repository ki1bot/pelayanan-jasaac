<?php

use App\Http\Controllers\AdminCrudController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HalamanController::class, 'beranda'])->name('beranda');

Route::get('/beli-ac', [HalamanController::class, 'beli'])->name('beli.form');
Route::get('/jual-ac', [HalamanController::class, 'jual'])->name('jual.form');
Route::get('/service-ac', [HalamanController::class, 'service'])->name('service.form');

Route::get('/harga-beli-ac', [HalamanController::class, 'hargaBeli'])->name('harga.beli');
Route::get('/harga-jual-ac', [HalamanController::class, 'hargaJual'])->name('harga.jual');
Route::get('/harga-service-ac', [HalamanController::class, 'hargaService'])->name('harga.service');

Route::get('/harga', function () {
    return redirect()->route('harga.beli');
})->name('harga');

Route::get('/tentang', [HalamanController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [HalamanController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [HalamanController::class, 'simpanKontak'])->name('kontak.simpan');

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');

Route::get('/auth/{provider}', [AuthController::class, 'redirectProvider'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [AuthController::class, 'callbackProvider'])->name('social.callback');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('/ubah-password', [AuthController::class, 'updatePassword'])->name('password.update');

    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::post('/checkout', [KeranjangController::class, 'checkout'])->name('checkout');

    Route::get('/pembayaran/{id}', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/{id}', [PembayaranController::class, 'store'])->name('pembayaran.store');
});

Route::middleware(['auth', 'pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/crud/{jenis}', [AdminCrudController::class, 'index'])->name('crud.index');
    Route::get('/crud/{jenis}/tambah', [AdminCrudController::class, 'create'])->name('crud.create');
    Route::post('/crud/{jenis}', [AdminCrudController::class, 'store'])->name('crud.store');
    Route::get('/crud/{jenis}/{id}/edit', [AdminCrudController::class, 'edit'])->name('crud.edit');
    Route::put('/crud/{jenis}/{id}', [AdminCrudController::class, 'update'])->name('crud.update');
    Route::delete('/crud/{jenis}/{id}', [AdminCrudController::class, 'destroy'])->name('crud.destroy');
});
