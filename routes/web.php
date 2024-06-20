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

// Route Halaman
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
Route::get('admin/akun_admin', [AdminController::class, 'account_data']); // data akun admin
Route::get('admin/data_kelas', [AdminController::class, 'data_kelas']); // data kelas
Route::get('admin/data_mapel', [AdminController::class, 'data_mapel']); // data mapel
Route::get('admin/data_ekskul', [AdminController::class, 'data_ekskul']); //data ekskul

// Route Tambah Data
Route::post('admin/tambah_akun', [AdminController::class, 'tambah_akun']); // data akun admin
Route::post('admin/tambah_kelas', [AdminController::class, 'tambah_kelas']); // data kelas
Route::post('admin/tambah_mapel', [AdminController::class, 'tambah_mapel']); //data mapel
Route::post('admin/tambah_ekskul', [AdminController::class, 'tambah_ekskul']); //data ekskul

// Route Ubah Data
Route::put('admin/ubah_akun/{id}', [AdminController::class, 'ubah_akun']); // data akun admin
Route::put('admin/ubah_kelas/{id}', [AdminController::class, 'ubah_kelas']); // data kelas
Route::put('admin/ubah_mapel/{id}', [AdminController::class, 'ubah_mapel']); //data mapel
Route::put('admin/ubah_ekskul/{id}', [AdminController::class, 'ubah_ekskul']); //data ekskul

// Route Hapus Data
Route::get('admin/hapus_akun/{id}', [AdminController::class, 'hapus_akun']); // data akun admin
Route::get('admin/hapus_kelas/{id}', [AdminController::class, 'hapus_kelas']); // data kelas
Route::get('admin/hapus_mapel/{id}', [AdminController::class, 'hapus_mapel']); //data mapel
Route::get('admin/hapus_ekskul/{id}', [AdminController::class, 'hapus_ekskul']); //data ekskul

// Route Ambil Data
Route::get('admin/get_users_edit/{id}', [AdminController::class, 'get_users_edit']); // data akun admin
Route::get('admin/get_users_delete/{id}', [AdminController::class, 'get_users_delete']); // data akun admin
Route::get('admin/get_kelas/{id}', [AdminController::class, 'get_class']); // data kelas
Route::get('admin/get_data_delete/{id}', [AdminController::class, 'get_class_delete']); // data kelas
Route::get('admin/get_mapel/{id}', [AdminController::class, 'get_data_mapel']); // data mapel
Route::get('admin/get_mapel_delete/{id}', [AdminController::class, 'get_mapel_delete']); // data mapel
Route::get('admin/get_ekskul_edit/{id}', [AdminController::class, 'get_ekskul_edit']); // data ekskul
Route::get('admin/get_ekskul_delete/{id}', [AdminController::class, 'get_ekskul_delete']); // data ekskul
