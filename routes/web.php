<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TanggapanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/', [SesiController::class, 'login']);
Route::get('/', [SesiController::class, 'index'])->name('login');

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [SesiController::class, 'logout']);
    
    Route::group(['middleware' => ['cekUser:admin']], function () {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::resource('/admin/petugas', PetugasController::class);
        Route::resource('/admin/siswa', SiswaController::class);
        Route::resource('/admin/pelanggaran', PelanggaranController::class);
        Route::resource('/admin/tanggapan', TanggapanController::class);
        Route::get('/admin/siswa', [SiswaController::class, 'search'])->name('search');
    });
    Route::group(['middleware' => ['cekUser:gurubk']], function () {
        Route::resource('/guru/siswa',SiswaController::class);
        Route::resource('/guru/pelanggaran',PelanggaranController::class);
        Route::resource('/guru/tanggapan',TanggapanController::class);

        Route::get('/guru/siswa', [SiswaController::class, 'search'])->name('search');
        Route::get('/guru/pelanggaran', [PelanggaranController::class, 'search'])->name('search');
        Route::get('/guru/tanggapan', [TanggapanController::class, 'search'])->name('search');
        Route::get('/guru', [GuruController::class, 'index']);
        Route::put('/guru/tanggapan', [TanggapanController::class, 'update']);
        Route::put('/guru/pelanggaran', [PelanggaranController::class, 'store']);
    });
});
