<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

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
Route::get('/', [AuthController::class, 'auth'])->name('auth');
Route::post('/auth_process', [AuthController::class, 'auth_process']);


Route::middleware(['checkrole:1'])->group(function () {
    // Route halaman
    Route::get('/admin/', [AdminController::class, 'index'])->name('dashboard-admin');
    Route::get('admin/manajemen_akun/', [AdminController::class, 'account'])->name('manajemen-akun');
    Route::get('admin/data/tahun_ajaran', [AdminController::class, 'tahun_ajaran'])->name('data-tahun-ajaran');
    Route::get('admin/data/kejuruan', [AdminController::class, 'kejuruan'])->name('data-kejuruan');
    Route::get('admin/data/guru', [AdminController::class, 'teacher'])->name('data-guru');
    Route::get('admin/data/siswa', [AdminController::class, 'student'])->name('data-siswa');
    Route::get('admin/data/kelas', [AdminController::class, 'class_room'])->name('data-kelas');
    Route::get('admin/data/mapel', [AdminController::class, 'mapel'])->name('data-mapel');
    Route::get('admin/data/ekskul', [AdminController::class, 'ekskul'])->name('data-ekskul');
    Route::get('admin/pengaturan/set-profil-sekolah', [AdminController::class, 'set_profil'])->name('profil-sekolah');
    Route::get('admin/pengaturan/set-wakel', [AdminController::class, 'set_wakel'])->name('pilih-wakel'); // set wakel per kelas
    Route::get('admin/pengaturan/set-mapel', [AdminController::class, 'set_mapel'])->name('pilih-guru-mapel'); //set guru mapel
    Route::get('admin/pesan', [AdminController::class, 'pesan'])->name('pesan'); // pesan

    // Route Data
    Route::get('admin/akun_admin', [AdminController::class, 'account_data']); // data akun admin
    Route::get('admin/data/data_kejuruan', [AdminController::class, 'data_kejuruan']); // data jurusan
    Route::get('admin/data/data_guru', [AdminController::class, 'data_guru']); // data guru
    Route::get('admin/data/data_siswa', [AdminController::class, 'data_siswa']); // data siswa
    Route::get('admin/data/data_kelas', [AdminController::class, 'data_kelas']); // data kelas
    Route::get('admin/data/data_mapel', [AdminController::class, 'data_mapel']); // data mapel
    Route::get('admin/data/data_ekskul', [AdminController::class, 'data_ekskul']); //data ekskul
    Route::get('admin/data/data_tahun_ajaran', [AdminController::class, 'data_tahun_ajaran']); // data tahun ajaran
    Route::get('admin/pengaturan/get_kelas_wakel', [AdminController::class, 'get_kelas_wakel']); // set wakel
    Route::get('admin/pengaturan/data_guru_mapel', [AdminController::class, 'data_guru_mapel']); // set mapel

    Route::get('admin/data/get_teacher_users/{id}', [AdminController::class, 'users_teacher']);


    // Route Tambah Data
    Route::post('admin/tambah_akun', [AdminController::class, 'tambah_akun']); // data akun admin
    Route::post('admin/data/tambah_tahun_ajaran', [AdminController::class, 'tambah_th_aj']); // data guru
    Route::post('admin/data/tambah_guru', [AdminController::class, 'tambah_guru']); // data guru
    Route::post('admin/data/tambah_siswa', [AdminController::class, 'tambah_siswa']); // data siswa
    Route::post('admin/data/tambah_kelas', [AdminController::class, 'tambah_kelas']); // data kelas
    Route::post('admin/data/tambah_mapel', [AdminController::class, 'tambah_mapel']); //data mapel
    Route::post('admin/data/tambah_ekskul', [AdminController::class, 'tambah_ekskul']); //data ekskul
    Route::post('admin/data/tambah_kejuruan', [AdminController::class, 'tambah_kejuruan']); // data kejuruan
    Route::post('admin/kirim_pesan', [AdminController::class, 'send_message']); // pesan

    // Route Ubah Data
    Route::put('admin/ubah_akun/{id}', [AdminController::class, 'ubah_akun']); // data akun admin
    Route::put('admin/data/ubah_guru/{id}', [AdminController::class, 'ubah_guru']); // data guru
    Route::put('admin/data/ubah_siswa/{id}', [AdminController::class, 'ubah_siswa']); // data siswa
    Route::put('admin/data/ubah_kelas/{id}', [AdminController::class, 'ubah_kelas']); // data kelas
    Route::put('admin/data/ubah_mapel/{id}', [AdminController::class, 'ubah_mapel']); //data mapel
    Route::put('admin/data/ubah_ekskul/{id}', [AdminController::class, 'ubah_ekskul']); //data ekskul
    Route::post('admin/pengaturan/update_profile_sekolah', [AdminController::class, 'update_profile_sekolah']); // profil sekolah
    Route::put('admin/data/ubah_kejuruan/{id}', [AdminController::class, 'ubah_kejuruan']); // data kejuruan
    Route::put('admin/data/ubah_tahun_ajaran/{id}', [AdminController::class, 'ubah_tahun_ajaran']); // data kejuruan

    // Route Hapus Data
    Route::get('admin/hapus_akun/{id}', [AdminController::class, 'hapus_akun']); // data akun admin
    Route::get('admin/data/hapus_tahun_ajaran/{id}', [AdminController::class, 'hapus_tahun_ajaran']); // data tahun ajaran
    Route::get('admin/data/hapus_guru/{id}', [AdminController::class, 'hapus_guru']); // data guru
    Route::get('admin/data/hapus_kelas/{id}', [AdminController::class, 'hapus_kelas']); // data kelas
    Route::get('admin/data/hapus_mapel/{id}', [AdminController::class, 'hapus_mapel']); //data mapel
    Route::get('admin/data/hapus_ekskul/{id}', [AdminController::class, 'hapus_ekskul']); //data ekskul
    Route::get('admin/data/hapus-siswa/{id}', [AdminController::class, 'hapus_siswa']); //data siswa
    Route::get('admin/data/hapus_kejuruan/{id}', [AdminController::class, 'hapus_kejuruan']); // data kejuruan

    // Route Ambil Data
    Route::get('admin/get_users_edit/{id}', [AdminController::class, 'get_users_edit']); // data akun admin
    Route::get('admin/get_users_delete/{id}', [AdminController::class, 'get_users_delete']); // data akun admin
    Route::get('admin/data/get_teacher_edit/{id}', [AdminController::class, 'get_teacher_edit']); // data guru
    Route::get('admin/data/get_teacher_delete/{id}', [AdminController::class, 'get_teacher_delete']); //data guru
    Route::get('admin/data/get_tahun_ajaran/{id}', [AdminController::class, 'get_data_th_aj']); //data siswa
    Route::get('admin/data/get_siswa/{id}', [AdminController::class, 'get_siswa']); //data siswa
    Route::get('admin/data/get_data_kelas', [AdminController::class, 'get_data_kelas']); // semua data kelas
    Route::get('admin/data/get_kelas/{id}', [AdminController::class, 'get_class']); // data kelas
    Route::get('admin/data/get_data_delete/{id}', [AdminController::class, 'get_class_delete']); // data kelas
    Route::get('admin/data/get_mapel/{id}', [AdminController::class, 'get_data_mapel']); // data mapel
    Route::get('admin/data/get_mapel_delete/{id}', [AdminController::class, 'get_mapel_delete']); // data mapel
    Route::get('admin/data/get_ekskul_edit/{id}', [AdminController::class, 'get_ekskul_edit']); // data ekskul
    Route::get('admin/data/get_ekskul_delete/{id}', [AdminController::class, 'get_ekskul_delete']); // data ekskul
    Route::get('admin/data/get_tingkat', [AdminController::class, 'get_tingkat']); //data tingkat
    Route::get('admin/data/get_student_level/{id}', [AdminController::class, 'get_siswa_tingkat']); // siswa non class
    Route::get('admin/data/get_student_class/{id}', [AdminController::class, 'get_siswa_class']); // siswa class
    Route::get('admin/data/get_kejuruan/{id}', [AdminController::class, 'get_kejuruan']); // ambil data kejuruan
    Route::get('admin/data/get_jurusan', [AdminController::class, 'get_jurusan']); // ambil data jurusan
    Route::get('admin/data/get_data_siswa/{id}', [AdminController::class, 'get_siswa_users']); // data username siswa
    Route::get('admin/pengaturan/profil_smk', [AdminController::class, 'profil_smk']); // profil sekolah

    // Route kirim dan keluarkan siswa di kelas
    Route::post('admin/data/send_student_to_class', [AdminController::class, 'send_student_class']); // mengirim siswa ke kelas
    Route::post('admin/data/drop_student_class', [AdminController::class, 'drop_student_class']); // mengeluarkan siswa dari kelas

    // Route import data
    Route::post('admin/data/import_siswa', [AdminController::class, 'import_siswa']); // import data siswa
    Route::post('admin/data/import-guru', [AdminController::class, 'import_guru']); // import data guru
    Route::post('admin/data/import-kejuruan', [AdminController::class, 'import_kejuruan']); // import data jurusan
    Route::post('admin/data/import-mapel', [AdminController::class, 'import_mapel']); // import data jurusan

    // Route Set Data
    Route::post('admin/pengaturan/select_guru_mapel', [AdminController::class, 'select_guru_mapel']); // pilih guru per mapel
    Route::post('admin/pengaturan/pilih_wakel', [AdminController::class, 'select_wakel']); // proses milih wakel per kelas

    // tess
    Route::get('admin/data_pesan', [AdminController::class, 'getMessages']);
    Route::get('admin/get_pesan/{id}', [AdminController::class, 'getPesan']);
    Route::get('admin/hapus_pesan/{id}', [AdminController::class, 'hapusPesan']);

    // hitung data
    Route::get('cetak_username_guru', [AdminController::class, 'cetak_user_guru']);
    Route::get('cetak_username_siswa/{id}', [AdminController::class, 'cetak_user_siswa']);
    Route::get('admin/pengaturan/get_mapel_class/{id}', [AdminController::class, 'view_mapel_class']);
});

Route::middleware(['checkrole:2'])->group(function () {
    Route::get('guru/', [TeacherController::class, 'home'])->name('home');
    Route::get('guru/input/show_mapel/{year}/{semester}', [TeacherController::class, 'show_mapel']);
    Route::get('guru/input/show_student/{id}', [TeacherController::class, 'show_nilai']);
    Route::get('guru/input/show_siswa_sikap/{year}/{smt}', [TeacherController::class, 'show_siswa_sikap']);
    Route::get('guru/input/show_siswa_absensi/{year}/{smt}', [TeacherController::class, 'show_siswa_absensi']);
    Route::get('guru/input/show_siswa_ekskul', [TeacherController::class, 'show_siswa_absensi']);
    // Route Kirim Data
    Route::post('guru/input/kirim_nilai', [TeacherController::class, 'kirim_nilai']);
    Route::post('guru/input/kirim_nilai_sikap', [TeacherController::class, 'kirim_nilai_sikap']);
    Route::post('guru/input/kirim_absensi', [TeacherController::class, 'kirim_absensi']);

    // Route Halaman
    Route::get('guru/input/nilai', [TeacherController::class, 'input_nilai'])->name('input_nilai');
    Route::get('guru/input/nilai_sikap', [TeacherController::class, 'input_nilai_sikap'])->name('input_nilai_sikap');
    Route::get('guru/input/absensi', [TeacherController::class, 'input_absensi'])->name('input_absensi');
    Route::get('guru/input/nilai_ekskul', [TeacherController::class, 'nilai_ekskul'])->name('nilai_ekskul');
    Route::get('guru/input/kenaikan', [TeacherController::class, 'kenaikan'])->name('kenaikan');
    Route::get('guru/cetak/raport', [TeacherController::class, 'cetak_raport'])->name('cetak_raport');
    Route::get('guru/cetak/leger', [TeacherController::class, 'cetak_leger'])->name('cetak_leger');
});

Route::middleware(['checkrole:3'])->group(function () {
    Route::get('siswa/', [StudentController::class, 'home'])->name('home_siswa');
    Route::get('siswa/lihat_nilai', [StudentController::class, 'lihat_nilai'])->name('lihat_nilai');
    Route::get('siswa/cetak_raport', [StudentController::class, 'cetak_raport'])->name('cetak_raport_siswa');
});

// Logout Route
Route::get('logout', [AuthController::class, 'logout']);
Route::get('admin/logout', [AuthController::class, 'logout']);
Route::get('admin/data/logout', [AuthController::class, 'logout']);
Route::get('admin/pengaturan/logout', [AuthController::class, 'logout']);
Route::get('guru/logout', [AuthController::class, 'logout']);
Route::get('guru/input/logout', [AuthController::class, 'logout']);
Route::get('guru/cetak/logout', [AuthController::class, 'logout']);
Route::get('siswa/logout', [AuthController::class, 'logout']);
Route::get('pesan_dashboard', [TeacherController::class, 'dashboard_message']);
Route::get('hitung_siswa', [TeacherController::class, 'hitung_data_siswa']);
Route::get('pesan_dashboard', [StudentController::class, 'dashboard_message']);
Route::get('hitung_siswa', [StudentController::class, 'hitung_data_siswa']);
Route::get('hitung_siswa', [AdminController::class, 'hitung_data_siswa']);
Route::get('pesan_dashboard', [AdminController::class, 'dashboard_message']);









