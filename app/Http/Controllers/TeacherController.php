<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Ekskul;
use App\Models\NilaiSiswa;
use App\Models\TahunAjaran;
use App\Models\HistoryGuruMapel;
use App\Models\HistoryWakel;
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
        $userData = session('userData');
        $guruId = $userData->user_id;

        $tahun = HistoryGuruMapel::where('guru_id', $guruId)
        ->distinct()
        ->get(['tahun_ajaran']);
        return view('guru.input_nilai', compact('tahun'));
    }

    public function show_mapel($year, $semester)
    {
        $userData = session('userData');

        $guruId = $userData->user_id;

        $tahun = $year . '/' . $semester;

        $mapel = HistoryGuruMapel::where('guru_id', $guruId)
        ->where('tahun_ajaran', $tahun)
        ->join('kelas', 'h_guru_mapel.class_id', '=', 'kelas.id')
        ->join('mapel', 'h_guru_mapel.mapel_id', '=', 'mapel.id')
        ->join('users', 'h_guru_mapel.guru_id', '=', 'users.id')
        ->join('personal_data', 'users.personal_id', '=', 'personal_data.id')
        ->select('personal_data.nama', 'kelas.nama_rombel', 'mapel.nama_mapel', 'mapel.id as mapel_id')
        ->get();

        return view('guru.show_mapel', compact('mapel'));
    }

    public function show_nilai($mapel_id)
    {
        $g = HistoryGuruMapel::where('mapel_id', $mapel_id)->first();
        $classId = $g->class_id;
        $mapelid = $g->mapel_id;
        $tapel = $g->tahun_ajaran;

        $siswa = DB::select("
            SELECT u.id as user_id, s.nisn, pd.nama, pd.jenis_kelamin, m.nama_mapel, n.nilai_pengetahuan, n.nilai_keterampilan
            FROM users u
            JOIN personal_data pd ON u.personal_id = pd.id
            JOIN siswa s ON s.user_id = u.id
            JOIN kelas_siswa ks ON ks.user_id = u.id
            JOIN history_siswa hs ON hs.user_id = u.id
            LEFT JOIN nilai n ON n.user_id = u.id AND n.mapel_id = ?
            LEFT JOIN mapel m ON m.id = ?
            WHERE m.id = ? AND hs.class_id = ? AND hs.tahun_ajaran = ?
        ", [$mapel_id, $mapel_id, $mapel_id, $classId, $tapel]);

        return view('guru.nilai', compact('siswa', 'mapelid', 'tapel'));
    }

    public function kirim_nilai(Request $request)
    {
        $user_ids = $request->input('user_id'); // Ini seharusnya array
        $tahun_ajaran = $request->input('tahun_ajaran'); // Ini adalah array
        $mapel_id = $request->input('mapel_id');
        $np = $request->input('np');
        $nk = $request->input('nk');

        // Ambil tahun ajaran aktif dari database
        $tahunAktif = TahunAjaran::where('status', 'Y')->first();

        if (!$tahunAktif) {
            return response()->json(['message' => 'Tahun ajaran aktif tidak ditemukan'], 404);
        }

        // Pastikan tahun ajaran aktif sesuai dengan yang diterima
        if ($tahun_ajaran[0] == $tahunAktif->tahun) {
            foreach ($user_ids as $index => $userId) {
                $user_id = $userId;
                $th = $tahun_ajaran[0];
                $m_id = $mapel_id[0];
                $nilai_p = $np[$index];
                $nilai_k = $nk[$index];

                $existing = NilaiSiswa::where('user_id', $user_id)
                    ->where('mapel_id', $m_id)
                    ->where('tahun_ajaran', $th)
                    ->first();

                if ($existing) {
                    // Update data nilai jika sudah ada
                    $existing->nilai_pengetahuan = $nilai_p;
                    $existing->nilai_keterampilan = $nilai_k;
                    $existing->save();
                } else {
                    // Tambah data nilai jika belum ada
                    $nilai = new NilaiSiswa();
                    $nilai->user_id = $user_id;
                    $nilai->mapel_id = $m_id;
                    $nilai->tahun_ajaran = $th; // Gunakan tahun ajaran aktif
                    $nilai->nilai_pengetahuan = $nilai_p;
                    $nilai->nilai_keterampilan = $nilai_k;
                    $nilai->save();
                }
            }

            // Mengembalikan respons setelah semua data diproses
            return response()->json(['message' => 'Nilai berhasil disimpan atau diperbarui']);
        } else {
            return response()->json(['message' => 'Tahun ajaran yang diterima tidak sesuai dengan tahun ajaran aktif'], 400);
        }
    }

    public function input_nilai_sikap()
    {
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = TahunAjaran::get();
        $tahun = HistoryWakel::where('guru_id', $guruId)
        ->distinct()
        ->get(['tahun_ajaran']);
        return view('guru.input_nilai_sikap', compact('tahun'));
    }

    public function show_siswa_sikap($year, $smt)
    {
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = $year . '/' . $smt;

        $hw = HistoryWakel::where('tahun_ajaran', $tahun)->first();

        $classId = $hw->class_id;
        $class = $classId;
        $ta = $hw->tahun_ajaran;

        $data = DB::table('users as u')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
        ->leftJoin('nilai_sikap as ns', 'ns.user_id', '=', 'u.id')
        ->select('pd.nama', 'ns.spiritual', 'ns.sosial', 'u.id as user_id')
        ->where('u.role_id', 3)
        ->where('hs.tahun_ajaran', $ta)
        ->where('hs.class_id', $class)
        ->get();

        return view('guru.show_siswa_sikap', compact('data', 'ta', 'class'));
    }

    public function kirim_nilai_sikap(Request $request)
    {
        $class_id = $request->class_id;
        $tahun_ajaran = $request->tahun_ajaran;
        $user_ids = $request->user_id;

        foreach($user_ids as $user_id)
        {
            echo $user_id."<br>";
        }
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
