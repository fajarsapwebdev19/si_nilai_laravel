<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function home()
    {
        $siswa = Siswa::all()->count();
        $guru = Guru::all()->count();
        $kelas = Kelas::all()->count();
        $pengguna = User::all()->count();
        return view('siswa.index', compact('siswa', 'guru', 'kelas', 'pengguna'));
    }

    public function lihat_nilai()
    {
        $tahun = TahunAjaran::get();
        $userData = session('userData');
        $userId = $userData->user_id;
        $kelas = DB::table('kelas as k')
        ->join('kelas_siswa as ks', 'k.id', '=', 'ks.class_id')
        ->where('ks.user_id', $userId)
        ->select('k.nama_rombel', 'k.tingkat', 'k.jurusan_id')
        ->first();

        $tingkat = $kelas->tingkat;
        $jurusan_id = $kelas->jurusan_id;


        $mapel = Mapel::where('tingkat', $tingkat)
              ->where('jurusan_id', $jurusan_id)
              ->get();

        return view('siswa.lihat_nilai', compact('tahun', 'kelas', 'mapel'));
    }

    public function cetak_raport(){
        $tahun = TahunAjaran::get();
        return view('siswa.cetak_raport', compact('tahun'));
    }
}
