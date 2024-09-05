<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiSiswa;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Ekskul;
use App\Models\NilaiSikap;
use App\Models\NilaiEkskul;
use App\Models\Kenaikan;
use App\Models\HistorySiswa;
use App\Models\HistoryWakel;
use App\Models\Kelas;
use App\Models\User;
use App\Models\NilaiSiswa;
use App\Models\TahunAjaran;
use App\Models\ProfilSekolah;
use App\Models\Info;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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

        $tahun = HistorySiswa::where('user_id', $userId)
        ->distinct()
        ->get(['tahun_ajaran']);

        return view('siswa.lihat_nilai', compact('tahun'));
    }

    public function show_nilai_siswa(Request $request)
    {
        $th = $request->tapel;
        $parts = explode(" ", $th);
        $userData = session('userData');
        $userId = $userData->user_id;

        $s = DB::table('users as u')
        ->join('personal_data as pd', 'u.personal_id' , '=' , 'pd.id')
        ->select('pd.nama')
        ->where('u.id', $userId)
        ->first();

        $smt = $parts[1];
        $tahun_ajaran = $parts[0];

        if($smt == 1)
        {
            $semester = "Ganjil";
        }
        else{
            $semester = "Genap";
        }

        $hs = HistorySiswa::where('user_id', $userId)
        ->where('tahun_ajaran', $th)
        ->first();
        $classId = $hs->class_id;

        // nama kelas
        $k = Kelas::where('id', $classId)->first();

        // mapel
        $mp = DB::table('guru_mapel as gm')
        ->join('mapel as m', 'gm.mapel_id', '=', 'm.id')
        ->where('gm.class_id', $classId)
        ->orderBy('m.kelompok', 'asc')
        ->orderBy('m.urutan', 'asc')->get();

        // nilai
        $nilai = NilaiSiswa::where('user_id', $userId)
        ->where('tahun_ajaran', $th)->get();

        return view('siswa.show_nilai', compact('s', 'k', 'tahun_ajaran', 'smt', 'semester', 'mp', 'nilai'));
    }

    public function cetak_raport()
    {
        $userData = session('userData');
        $userId = $userData->user_id;
        $tahun = HistorySiswa::where('user_id', $userId)
        ->distinct()
        ->get(['tahun_ajaran']);
        return view('siswa.cetak_raport', compact('tahun'));
    }

    public function cetak_r_siswa(Request $request)
    {
        $tapel = $request->tapel;
        $userData = session('userData');
        $siswaId = $userData->user_id;

        // Ambil class_id berdasarkan history siswa (tahun ajaran)
        $hs = HistorySiswa::where('user_id', $siswaId)
            ->where('tahun_ajaran', $tapel)->first();
        $classId = $hs->class_id;

        // Ambil nama kelas
        $k = Kelas::where('id', $classId)->first();
        $nama_kelas = $k->nama_rombel;

        // semester
        $smt = TahunAjaran::where("tahun", $tapel)->first();

        if($smt->semester == 1)
        {
            $semester = "Ganjil";
        }else{
            $semester = "Genap";
        }

        $parts = explode(" ", $tapel);
        $tahun_ajaran = $parts[0];

        // sekolah
        $sekolah = ProfilSekolah::first();
        $ksId = $sekolah->kep_id;

        // data siswa
        $siswa = DB::table('siswa as s')
        ->select('s.*', 'pd.*', 'k.nama_kejuruan')
        ->join('users as u', 's.user_id', '=' ,'u.id')
        ->join('personal_data as pd', 'u.personal_id', '=' , 'pd.id')
        ->join('kejuruan as k', 's.jurusan_id', '=', 'k.id')
        ->where('u.id', $siswaId)->first();

        // Ambil mata pelajaran kelompok A
        $kel_a = DB::select("
            SELECT m.id, m.urutan, m.nama_mapel, m.kkm
            FROM guru_mapel gm
            JOIN mapel m ON gm.mapel_id = m.id
            WHERE gm.class_id = ?
            AND m.kelompok = ?
            ORDER BY m.urutan ASC
        ", [$classId, 'A']);

        // Ambil mata pelajaran kelompok B
        $kel_b = DB::select("
            SELECT m.id, m.urutan, m.nama_mapel, m.kkm
            FROM guru_mapel gm
            JOIN mapel m ON gm.mapel_id = m.id
            WHERE gm.class_id = ?
            AND m.kelompok = ?
            ORDER BY m.urutan ASC
        ", [$classId, 'B']);

        // Ambil mata pelajaran kelompok C1
        $kel_c1 = DB::select("
            SELECT m.id, m.urutan, m.nama_mapel, m.kkm
            FROM guru_mapel gm
            JOIN mapel m ON gm.mapel_id = m.id
            WHERE gm.class_id = ?
            AND m.kelompok = ?
            ORDER BY m.urutan ASC
        ", [$classId, 'C1']);

        // Ambil mata pelajaran kelompok C2
        $kel_c2 = DB::select("
            SELECT m.id, m.urutan, m.nama_mapel, m.kkm
            FROM guru_mapel gm
            JOIN mapel m ON gm.mapel_id = m.id
            WHERE gm.class_id = ?
            AND m.kelompok = ?
            ORDER BY m.urutan ASC
        ", [$classId, 'C2']);

        // Ambil mata pelajaran kelompok C3
        $kel_c3 = DB::select("
            SELECT m.id, m.urutan, m.nama_mapel, m.kkm
            FROM guru_mapel gm
            JOIN mapel m ON gm.mapel_id = m.id
            WHERE gm.class_id = ?
            AND m.kelompok = ?
            ORDER BY m.urutan ASC
        ", [$classId, 'C3']);

        // Ambil nilai siswa
        $nilai = NilaiSiswa::where('user_id', $siswaId)
            ->where('tahun_ajaran', $tapel)->get();

        // Nilai Sikap
        $ns = NilaiSikap::where('user_id', $siswaId)
        ->where('tahun_ajaran', $tapel)
        ->first();

        // Kenaikan
        $kn = Kenaikan::where('user_id', $siswaId)
        ->where('tahun_ajaran', $tapel)
        ->first();

        // Ketidakhadiran Siswa (Absensi)
        $kt = AbsensiSiswa::where('user_id', $siswaId)
        ->where('tahun_ajaran', $tapel)
        ->first();

        // Ekskul
        $e = Ekskul::all();

        // Nilai Ekskul
        $ne = NilaiEkskul::where('user_id', $siswaId)
        ->where('tahun_ajaran', $tapel)
        ->first();

        // Ambil Nama Wakel
        $hw = HistoryWakel::where('class_id', $classId)
        ->where('tahun_ajaran', $tapel)
        ->first();

        $guruId = $hw->guru_id;

        $w = DB::table('users as u')
        ->join('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->select('pd.nama')
        ->where('u.id', $guruId)->first();

        $ks = DB::table('users as u')
        ->join('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->select('pd.nama')
        ->where('u.id', $ksId)->first();

        $pdf = PDF::loadView('cetak.raport_siswa', compact('kel_a', 'kel_b', 'kel_c1','kel_c2','kel_c3', 'nilai', 'nama_kelas', 'siswaId', 'tapel', 'sekolah', 'siswa', 'tahun_ajaran', 'semester', 'smt', 'ns', 'kn', 'kt', 'e', 'ne', 'w', 'ks'));

        return $pdf->stream('Raport Siswa - ' . $siswa->nama .'('.$siswa->nisn.')'. '.pdf');
    }

    public function hitung_data_siswa()
    {
        $data = DB::table('kelas as k')
            ->leftJoin('kelas_siswa as ks', 'ks.class_id', '=', 'k.id')
            ->leftJoin('users as u', 'u.id', '=', 'ks.user_id')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->select(
                'k.nama_rombel',
                DB::raw("COUNT(CASE WHEN pd.jenis_kelamin = 'L' THEN 1 END) as L"),
                DB::raw("COUNT(CASE WHEN pd.jenis_kelamin = 'P' THEN 1 END) as P")
            )
            ->groupBy('k.nama_rombel')
            ->get();

        return response()->json($data);
    }

    public function dashboard_message()
    {
        // Mengambil data dengan relasi
        $data = Info::select('id', 'judul', 'isi', 'create_at', 'user_id')
            ->with(['user.personalData:id,nama']) // Mengambil kolom tertentu dari personal_data
            ->orderBy('create_at', 'desc') // Mengurutkan berdasarkan create_at secara ascending
            ->get();


        return view('pesan_in_dash', compact('data'));
    }
}
