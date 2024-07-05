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
Route::get('admin/data/guru', [AdminController::class, 'teacher'])->name('data-guru');
Route::get('admin/data/siswa', [AdminController::class, 'student'])->name('data-siswa');
Route::get('admin/data/kelas', [AdminController::class, 'class_room'])->name('data-kelas');
Route::get('admin/data/mapel', [AdminController::class, 'mapel'])->name('data-mapel');
Route::get('admin/data/ekskul', [AdminController::class, 'ekskul'])->name('data-ekskul');
Route::get('admin/pengaturan/set-profil-sekolah', [AdminController::class, 'set_profil'])->name('profil-sekolah');
Route::get('admin/pengaturan/set-wakel', [AdminController::class, 'set_wakel'])->name('pilih-wakel');
Route::get('admin/pengaturan/set-mapel', [AdminController::class, 'set_mapel'])->name('pilih-guru-mapel');

// Route Data
Route::get('admin/akun_admin', [AdminController::class, 'account_data']); // data akun admin
Route::get('admin/data/data_guru', [AdminController::class, 'data_guru']); // data guru
Route::get('admin/data/data_siswa', [AdminController::class, 'data_siswa']); // data siswa
Route::get('admin/data/data_kelas', [AdminController::class, 'data_kelas']); // data kelas
Route::get('admin/data/data_mapel', [AdminController::class, 'data_mapel']); // data mapel
Route::get('admin/data/data_ekskul', [AdminController::class, 'data_ekskul']); //data ekskul

// Route Tambah Data
Route::post('admin/tambah_akun', [AdminController::class, 'tambah_akun']); // data akun admin
Route::post('admin/data/tambah_guru', [AdminController::class, 'tambah_guru']); // data guru
Route::post('admin/data/tambah_siswa', [AdminController::class, 'tambah_siswa']); // data siswa
Route::post('admin/data/tambah_kelas', [AdminController::class, 'tambah_kelas']); // data kelas
Route::post('admin/data/tambah_mapel', [AdminController::class, 'tambah_mapel']); //data mapel
Route::post('admin/data/tambah_ekskul', [AdminController::class, 'tambah_ekskul']); //data ekskul

// Route Ubah Data
Route::put('admin/ubah_akun/{id}', [AdminController::class, 'ubah_akun']); // data akun admin
Route::put('admin/data/ubah_guru/{id}', [AdminController::class, 'ubah_guru']); // data guru
Route::put('admin/data/ubah_siswa/{id}', [AdminController::class, 'ubah_siswa']); // data siswa
Route::put('admin/data/ubah_kelas/{id}', [AdminController::class, 'ubah_kelas']); // data kelas
Route::put('admin/data/ubah_mapel/{id}', [AdminController::class, 'ubah_mapel']); //data mapel
Route::put('admin/data/ubah_ekskul/{id}', [AdminController::class, 'ubah_ekskul']); //data ekskul

// Route Hapus Data
Route::get('admin/hapus_akun/{id}', [AdminController::class, 'hapus_akun']); // data akun admin
Route::get('admin/data/hapus_guru/{id}', [AdminController::class, 'hapus_guru']); // data guru
Route::get('admin/data/hapus_kelas/{id}', [AdminController::class, 'hapus_kelas']); // data kelas
Route::get('admin/data/hapus_mapel/{id}', [AdminController::class, 'hapus_mapel']); //data mapel
Route::get('admin/data/hapus_ekskul/{id}', [AdminController::class, 'hapus_ekskul']); //data ekskul

// Route Ambil Data
Route::get('admin/get_users_edit/{id}', [AdminController::class, 'get_users_edit']); // data akun admin
Route::get('admin/get_users_delete/{id}', [AdminController::class, 'get_users_delete']); // data akun admin
Route::get('admin/data/get_teacher_edit/{id}', [AdminController::class, 'get_teacher_edit']); // data guru
Route::get('admin/data/get_teacher_delete/{id}', [AdminController::class, 'get_teacher_delete']); //data guru
Route::get('admin/data/get_siswa/{id}', [AdminController::class, 'get_siswa']); //data siswa
Route::get('admin/data/get_data_kelas', [AdminController::class, 'get_data_kelas']); // semua data kelas
Route::get('admin/data/get_kelas/{id}', [AdminController::class, 'get_class']); // data kelas
Route::get('admin/data/get_data_delete/{id}', [AdminController::class, 'get_class_delete']); // data kelas
Route::get('admin/data/get_mapel/{id}', [AdminController::class, 'get_data_mapel']); // data mapel
Route::get('admin/data/get_mapel_delete/{id}', [AdminController::class, 'get_mapel_delete']); // data mapel
Route::get('admin/data/get_ekskul_edit/{id}', [AdminController::class, 'get_ekskul_edit']); // data ekskul
Route::get('admin/data/get_ekskul_delete/{id}', [AdminController::class, 'get_ekskul_delete']); // data ekskul
Route::get('admin/data/get_tingkat', [AdminController::class, 'get_tingkat']); //data tingkat


Route::get('admin/data/get_student_level/{id}', [AdminController::class, 'get_siswa_tingkat']);
Route::get('admin/data/get_student_class/{id}', [AdminController::class, 'get_siswa_class']);
Route::post('admin/data/send_student_to_class', [AdminController::class, 'send_student_class']);
Route::post('admin/data/drop_student_class', [AdminController::class, 'drop_student_class']);

Route::post('admin/data/import_siswa', [AdminController::class, 'import_siswa']);
Route::get('admin/data/hapus-siswa/{id}', [AdminController::class, 'hapus_siswa']);

Route::post('admin/data/import-guru', [AdminController::class, 'import_guru']);

// test
Route::get('admin/pengaturan/profile_sekolah', [AdminController::class, 'update_profile_sekolah']);


