<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Ekskul;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function home()
    {
        $siswa = Siswa::all()->count();
        $guru = Guru::all()->count();
        $kelas = Kelas::all()->count();
        $pengguna = User::all()->count();
        return view('guru.index', compact('siswa', 'guru', 'kelas', 'pengguna'));
    }

    public function input_nilai()
    {
        $tahun = TahunAjaran::get();
        return view('guru.input_nilai', compact('tahun'));
    }

    public function show_mapel()
    {
        $userData = session('userData');

        $guruId = $userData->user_id;

        $mapel = DB::table('mapel as m')
        ->join('guru_mapel as gm', 'gm.mapel_id', '=', 'm.id')
        ->join('kejuruan as j', 'm.jurusan_id', '=', 'j.id')
        ->where('gm.guru_id', $guruId)
        ->select('m.*', 'gm.*', 'j.*')
        ->get();

        return view('guru.show_mapel', compact('mapel'));
    }

    public function input_nilai_sikap()
    {
        $tahun = TahunAjaran::get();
        return view('guru.input_nilai_sikap', compact('tahun'));
    }

    public function show_siswa_sikap()
    {
        $dataGuru = session('dataGuru');
        $classId = $dataGuru->class_id;
        $data = DB::table('kelas as k')
        ->leftJoin('kelas_siswa as ks', 'ks.class_id', '=', 'k.id')
        ->leftJoin('users as u', 'u.id', '=', 'ks.user_id')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->where('ks.class_id', $classId)
        ->select('k.*', 'ks.*', 'u.*', 'pd.*')
        ->get();

        return view('guru.show_siswa_sikap', compact('data'));
    }

    public function input_absensi()
    {
        $tahun = TahunAjaran::get();
        return view('guru.input_absensi', compact('tahun'));
    }

    public function show_siswa_absensi()
    {
        $dataGuru = session('dataGuru');
        $classId = $dataGuru->class_id;
        $data = DB::table('kelas as k')
        ->leftJoin('kelas_siswa as ks', 'ks.class_id', '=', 'k.id')
        ->leftJoin('users as u', 'u.id', '=', 'ks.user_id')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->where('ks.class_id', $classId)
        ->select('k.*', 'ks.*', 'u.*', 'pd.*')
        ->get();

        return view('guru.show_siswa_absen', compact('data'));
    }

    public function nilai_ekskul()
    {
        $dataGuru = session('dataGuru');
        $classId = $dataGuru->class_id;
        $siswa = DB::table('kelas as k')
        ->leftJoin('kelas_siswa as ks', 'ks.class_id', '=', 'k.id')
        ->leftJoin('users as u', 'u.id', '=', 'ks.user_id')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->where('ks.class_id', $classId)
        ->select('k.*', 'ks.*', 'u.*', 'pd.*')
        ->get();

        $tahun = TahunAjaran::get();
        $ekskul = Ekskul::get();
        return view('guru.nilai_ekskul', compact('tahun', 'ekskul', 'siswa'));
    }

    public function kenaikan()
    {
        $dataGuru = session('dataGuru');
        $classId = $dataGuru->class_id;
        $siswa = DB::table('kelas as k')
        ->leftJoin('kelas_siswa as ks', 'ks.class_id', '=', 'k.id')
        ->leftJoin('users as u', 'u.id', '=', 'ks.user_id')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->where('ks.class_id', $classId)
        ->select('k.*', 'ks.*', 'u.*', 'pd.*')
        ->get();

        $tahun = TahunAjaran::get();
        return view('guru.kenaikan', compact('tahun', 'siswa'));
    }

    public function cetak_raport(){
        $tahun = TahunAjaran::get();
        $dataGuru = session('dataGuru');
        $classId = $dataGuru->class_id;
        $siswa = DB::table('kelas as k')
        ->leftJoin('kelas_siswa as ks', 'ks.class_id', '=', 'k.id')
        ->leftJoin('users as u', 'u.id', '=', 'ks.user_id')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->where('ks.class_id', $classId)
        ->select('k.*', 'ks.*', 'u.*', 'pd.*')
        ->get();
        return view('guru.cetak_raport', compact('tahun', 'siswa'));
    }

    public function cetak_leger(){
        $tahun = TahunAjaran::get();
        return view('guru.cetak_leger', compact('tahun'));
    }
}
