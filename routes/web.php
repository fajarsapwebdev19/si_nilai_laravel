<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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
Route::get('/', [AuthController::class, 'auth']);
Route::get('admin/', [AdminController::class, 'index'])->name('dashboard-admin');
Route::get('admin/manajemen_akun/', [AdminController::class, 'account'])->name('manajemen-akun');
Route::get('admin/guru', [AdminController::class, 'teacher'])->name('data-guru');
Route::get('admin/siswa', [AdminController::class, 'student'])->name('data-siswa');
Route::get('admin/kelas', [AdminController::class, 'class_room'])->name('data-kelas');
Route::get('admin/mapel', [AdminController::class, 'mapel'])->name('data-mapel');
Route::get('admin/ekskul', [AdminController::class, 'ekskul'])->name('data-ekskul');
Route::get('admin/set-profil-sekolah', [AdminController::class, 'set_profil'])->name('profil-sekolah');
Route::get('admin/set-wakel', [AdminController::class, 'set_wakel'])->name('pilih-wakel');
Route::get('admin/set-mapel', [AdminController::class, 'set_mapel'])->name('pilih-guru-mapel');

// Route Data
Route::get('admin/data_kelas', [AdminController::class, 'data_kelas']);

// Route Tambah Data
Route::post('admin/tambah_kelas', [AdminController::class, 'tambah_kelas']);

// Route Ambil Data
Route::get('admin/get_kelas/{id}', [AdminController::class, 'get_class']);
