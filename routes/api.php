<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;

/*
|--------------------------------------------------------------------------
| Jalur API (API Routes)
|--------------------------------------------------------------------------
*/

// 1. JALUR UMUM (Publik)
// Siapapun bisa akses untuk melakukan login dan mendapatkan Token
Route::post('/login', [AuthController::class, 'login']);


// 2. JALUR TERTUTUP (Harus Login / Autentikasi)
// Semua jalur di dalam grup ini dikawal oleh "auth:sanctum"
Route::middleware('auth:sanctum')->group(function () {
    
    // Rute untuk CRUD Barang
    Route::get('/barang', [BarangController::class, 'index']);      // Tampil Data
    Route::post('/barang', [BarangController::class, 'store']);     // Tambah Data
    Route::put('/barang/{id}', [BarangController::class, 'update']);// Ubah Data
    Route::delete('/barang/{id}', [BarangController::class, 'destroy']); // Hapus Data
    
});