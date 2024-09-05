<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use App\Models\AbsensiSiswa;
use App\Models\Info;
use App\Models\Ekskul;
use App\Models\NilaiSiswa;
use App\Models\NilaiSikap;
use App\Models\NilaiEkskul;
use App\Models\Kenaikan;
use App\Models\TahunAjaran;
use App\Models\HistoryGuruMapel;
use App\Models\HistorySiswa;
use App\Models\HistoryWakel;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class TeacherController extends Controller
{
    // dashboard
    public function home()
    {
        $siswa = Siswa::all()->count();
        $guru = Guru::all()->count();
        $kelas = Kelas::all()->count();
        $pengguna = User::all()->count();
        return view('guru.index', compact('siswa', 'guru', 'kelas', 'pengguna'));
    }

    // pesan dashboard
    public function dashboard_message()
    {
        // Mengambil data dengan relasi
        $data = Info::select('id', 'judul', 'isi', 'create_at', 'user_id')
            ->with(['user.personalData:id,nama']) // Mengambil kolom tertentu dari personal_data
            ->orderBy('create_at', 'desc') // Mengurutkan berdasarkan create_at secara ascending
            ->get();


        return view('pesan_in_dash', compact('data'));
    }

    // jumlah siswa (grafik)
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

    // end dashboard

    // input nilai siswa

    public function input_nilai()
    {
        $userData = session('userData');
        $guruId = $userData->user_id;

        $tahun = HistoryGuruMapel::where('guru_id', $guruId)
        ->distinct()
        ->get(['tahun_ajaran']);
        return view('guru.input_nilai', compact('tahun'));
    }

    // menampilkan nama mapel yang diampu oleh guru
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

    // menampilkan nilai siswa berdasarkan mapel dan kelas
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

    // kirim nilai
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
                    $nilai->id = mt_rand();
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

    // end input nilai siswa

    // input nilai sikap siswa
    public function input_nilai_sikap()
    {
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = HistoryWakel::where('guru_id', $guruId)
        ->distinct()
        ->get(['tahun_ajaran']);
        return view('guru.input_nilai_sikap', compact('tahun'));
    }

    // show sikap siswa
    public function show_siswa_sikap($year, $smt)
    {
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = $year . '/' . $smt;

        $hw = HistoryWakel::where('tahun_ajaran', $tahun)
        ->where('guru_id', $guruId)
        ->first();

        $classId = $hw->class_id;
        $class = $classId;
        $ta = $hw->tahun_ajaran;

        $k = Kelas::where('id', $classId)->first();
        $nama_kelas = $k->nama_rombel;

        $nisi = DB::table('users as u')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
        ->leftJoin('nilai_sikap as ns', 'ns.user_id', '=', 'u.id')
        ->select('pd.nama', 'ns.spiritual', 'ns.sosial', 'u.id as user_id')
        ->where('u.role_id', 3)
        ->where('hs.class_id', $classId)
        ->where('ns.tahun_ajaran', $ta)
        ->count();

        if($nisi == 0)
        {
            $data = DB::table('users as u')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
            ->leftJoin('nilai_sikap as ns', 'ns.user_id', '=', 'u.id')
            ->select(
                'pd.nama',
                DB::raw('CASE WHEN ns.spiritual IS NOT NULL THEN NULL ELSE ns.spiritual END AS spiritual'),
                DB::raw('CASE WHEN ns.sosial IS NOT NULL THEN NULL ELSE ns.sosial END AS sosial'),
                'ns.tahun_ajaran',
                'u.id as user_id'
            )
            ->where('u.role_id', 3)
            ->where('hs.class_id', $classId)
            ->get();
        }else{
            $data = DB::table('users as u')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
            ->leftJoin('nilai_sikap as ns', 'ns.user_id', '=', 'u.id')
            ->select('pd.nama', 'ns.spiritual', 'ns.sosial', 'u.id as user_id')
            ->where('u.role_id', 3)
            ->where('hs.class_id', $classId)
            ->where('ns.tahun_ajaran', $ta)
            ->get();
        }

        return view('guru.show_siswa_sikap', compact('data', 'ta', 'class', 'nama_kelas'));
    }

    // kirim nilai sikap siswa
    public function kirim_nilai_sikap(Request $request)
    {
        $tahun_ajaran = $request->input('tahun_ajaran');
        $user_ids = $request->input('user_id');
        $spiritual = $request->input('spiritual');
        $sosial = $request->input('sosial');
        $tahunAktif = TahunAjaran::where('status', 'Y')->first();

        if (!$tahunAktif) {
            return response()->json(['message' => 'Tahun ajaran aktif tidak ditemukan'], 404);
        }

        if ($tahun_ajaran == $tahunAktif->tahun) {
            foreach ($user_ids as $index => $userId) {
                // cek data
                $existing = NilaiSikap::where('user_id', $userId)
                    ->where('tahun_ajaran', $tahun_ajaran)
                    ->first();

                $nilai_sp = $spiritual[$index];
                $nilai_ss = $sosial[$index];

                if ($existing) {
                    $existing->spiritual = $nilai_sp;
                    $existing->sosial = $nilai_ss;
                    $existing->save();
                } else {
                    $ns = new NilaiSikap();
                    $ns->id = mt_rand();
                    $ns->tahun_ajaran = $tahun_ajaran;
                    $ns->spiritual = $nilai_sp;
                    $ns->sosial = $nilai_ss;
                    $ns->user_id = $userId;
                    $ns->save();
                }
            }

            return response()->json(['message' => 'Nilai Sikap berhasil disimpan atau diperbarui']);
        } else {
            return response()->json(['message' => 'Tahun ajaran yang diterima tidak sesuai dengan tahun ajaran aktif'], 400);
        }
    }

    // end input nilai sikap siswa

    // input absensi sikap
    public function input_absensi()
    {
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = HistoryWakel::where('guru_id', $guruId)
        ->distinct()
        ->get(['tahun_ajaran']);
        return view('guru.input_absensi', compact('tahun'));
    }
    // show absensi siswa perkelas berdasarkan tahun ajaran
    public function show_siswa_absensi($year, $smt)
    {
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = $year . '/' . $smt;

        $hw = HistoryWakel::where('tahun_ajaran', $tahun)
        ->where('guru_id', $guruId)
        ->first();

        $classId = $hw->class_id;
        $ta = $hw->tahun_ajaran;

        $k = Kelas::where('id', $classId)->first();
        $nama_kelas = $k->nama_rombel;

        $absen = DB::table('users as u')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->leftJoin('siswa as s', 's.user_id', '=', 'u.id')
            ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
            ->leftJoin('absensi as a', 's.user_id', '=', 'a.user_id')
            ->select('s.nisn', 'pd.nama', 'pd.jenis_kelamin', 'a.sakit', 'a.izin', 'a.tanpa_keterangan', 'u.id as user_id')
            ->where('u.role_id', 3)
            ->where('hs.class_id', $classId)
            ->where('a.tahun_ajaran', $ta)
            ->count();

        if($absen == 0)
        {
            $data = DB::table('users as u')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->leftJoin('siswa as s', 's.user_id', '=', 'u.id')
            ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
            ->leftJoin('absensi as a', 's.user_id', '=', 'a.user_id')
            ->select('s.nisn', 'pd.nama', 'pd.jenis_kelamin',  DB::raw('CASE WHEN a.sakit IS NOT NULL THEN NULL ELSE a.sakit END AS sakit'), DB::raw('CASE WHEN a.izin IS NOT NULL THEN NULL ELSE a.izin END AS izin'), DB::raw('CASE WHEN a.tanpa_keterangan IS NOT NULL THEN NULL ELSE a.tanpa_keterangan END AS tanpa_keterangan'), 'u.id as user_id')
            ->where('u.role_id', 3)
            ->where('hs.class_id', $classId)
            ->get();
        }else{
            $data = DB::table('users as u')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->leftJoin('siswa as s', 's.user_id', '=', 'u.id')
            ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
            ->leftJoin('absensi as a', 's.user_id', '=', 'a.user_id')
            ->select('s.nisn', 'pd.nama', 'pd.jenis_kelamin', 'a.sakit', 'a.izin', 'a.tanpa_keterangan', 'u.id as user_id')
            ->where('u.role_id', 3)
            ->where('hs.class_id', $classId)
            ->where('a.tahun_ajaran', $ta)
            ->get();
        }

        return view('guru.show_siswa_absen', compact('data', 'classId', 'ta', 'nama_kelas'));
    }

    // kirim absensi
    public function kirim_absensi(Request $request)
    {
        $tahun_ajaran = $request->input('tahun_ajaran');
        $user_ids = $request->input('user_id');
        $hadir = $request->input('hadir');
        $izin = $request->input('izin');
        $tanpa_keterangan = $request->input('tanpa_keterangan');
        $tahunAktif = TahunAjaran::where('status', 'Y')->first();

        if (!$tahunAktif) {
            return response()->json(['message' => 'Tahun ajaran aktif tidak ditemukan'], 404);
        }

        if($tahun_ajaran == $tahunAktif->tahun)
        {
            foreach ($user_ids as $index => $userId) {
                // cek data
                $existing = AbsensiSiswa::where('user_id', $userId)
                    ->where('tahun_ajaran', $tahun_ajaran)
                    ->first();

                $h = $hadir[$index];
                $i = $izin[$index];
                $tk = $tanpa_keterangan[$index];

                if ($existing) {
                    $existing->sakit = $h;
                    $existing->izin = $i;
                    $existing->tanpa_keterangan = $tk;
                    $existing->save();
                } else {
                    $a = new AbsensiSiswa();
                    $a->id = mt_rand();
                    $a->tahun_ajaran = $tahun_ajaran;
                    $a->user_id = $userId;
                    $a->sakit = $h;
                    $a->izin = $i;
                    $a->tanpa_keterangan = $tk;
                    $a->save();
                }
            }
            return response()->json(['message' => 'Absensi berhasil disimpan atau diperbarui']);
        }
        else
        {
            return response()->json(['message' => 'Tahun ajaran yang diterima tidak sesuai dengan tahun ajaran aktif'], 400);
        }
    }

    // end input absensi siswa

    // input nilai ekskul
    public function nilai_ekskul()
    {
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = HistoryWakel::where('guru_id', $guruId)
        ->distinct()
        ->get(['tahun_ajaran']);
        return view('guru.nilai_ekskul', compact('tahun'));
    }
    // show ekskul siswa
    public function show_siswa_ekskul($year, $smt)
    {
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = $year . '/' . $smt;

        $hw = HistoryWakel::where('tahun_ajaran', $tahun)
        ->where('guru_id', $guruId)
        ->first();

        $tahun = $hw->tahun_ajaran;
        $class = $hw->class_id;

        $k = Kelas::where('id', $class)->first();
        $nama_kelas = $k->nama_rombel;

        $ekskul = Ekskul::all();

        return view('guru.show_nilai_ekskul', compact('ekskul', 'tahun', 'class', 'nama_kelas'));
    }

    // input nilai ekskul siswa per ekskul
    public function inputEkskul(Request $request)
    {
        $ekskulId = $request->query('ekskul_id');
        $tahun = $request->query('tahun');
        $classId = $request->query('class_id');

        $ekskul = DB::table('users as u')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
        ->leftJoin('ekskul as e', 'e.user_id', '=', 'u.id')
        ->select(
            'pd.nama',
            'e.tahun_ajaran',
            'e.ekskul_id',
            'e.nilai',
            'e.deskripsi',
            'u.id as user_id'
        )
        ->where('u.role_id', 3)
        ->where('hs.class_id', $classId)
        ->where('e.tahun_ajaran', $tahun)
        ->where('e.ekskul_id', $ekskulId)
        ->count();

        if($ekskul == 0)
        {
            $data = DB::table('users as u')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
            ->leftJoin('ekskul as e', 'e.user_id', '=', 'u.id')
            ->select(
                'pd.nama',
                'pd.jenis_kelamin',
                DB::raw('CASE WHEN e.nilai IS NOT NULL THEN NULL ELSE e.nilai END AS nilai'),
                DB::raw('CASE WHEN e.deskripsi IS NOT NULL THEN NULL ELSE e.deskripsi END AS deskripsi'),
                'u.id as user_id'
            )
            ->where('u.role_id', 3)
            ->where('hs.class_id', $classId)
            ->orderBy('pd.nama', 'asc')
            ->get();
        }else{
            $data = DB::table('users as u')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
            ->leftJoin('ekskul as e', 'e.user_id', '=', 'u.id')
            ->select(
                'pd.nama',
                'pd.jenis_kelamin',
                'e.nilai',
                'e.deskripsi',
                'u.id as user_id'
            )
            ->where('u.role_id', 3)
            ->where('hs.class_id', $classId)
            ->where('e.tahun_ajaran', $tahun)
            ->where('e.ekskul_id', $ekskulId)
            ->orderBy('pd.nama', 'asc')
            ->get();
        }

        $ek = Ekskul::where('id', $ekskulId)->first();
        $nama_ekskul = $ek->nama_ekstrakulikuler;

        return view('guru.input_nilai_ekskul', compact('data', 'ekskulId', 'tahun', 'classId', 'nama_ekskul'));
    }

    // kirim nilai ekskul
    public function kirim_nilai_ekskul(Request $request)
    {
        $tahun = $request->tahun;
        $ekskul_id = $request->ekskul_id;
        $user_id = $request->user_id;
        $nilai = $request->nilai;
        $deskripsi = $request->deskripsi;

        $th = TahunAjaran::where('status', 'Y')->first();

        if($th->tahun == $tahun)
        {
            foreach ($user_id as $index => $userId)
            {
                $n_e = $nilai[$index];
                $d_e = $deskripsi[$index];

                $existing = NilaiEkskul::where('tahun_ajaran', $tahun)
                ->where('ekskul_id', $ekskul_id)
                ->where('user_id', $userId)->first();

                if($existing)
                {
                    $existing->nilai = $n_e;
                    $existing->deskripsi = $d_e;
                    $existing->save();
                }else{
                    $ne = new NilaiEkskul();
                    $ne->id = mt_rand();
                    $ne->tahun_ajaran = $tahun;
                    $ne->user_id = $userId;
                    $ne->ekskul_id = $ekskul_id;
                    $ne->nilai = $n_e;
                    $ne->deskripsi = $d_e;
                    $ne->save();
                }
            }
            return response()->json(['message' => 'Nilai ekskul berhasil disimpan atau diperbarui']);
        }else {
            return response()->json(['message' => 'Tahun ajaran yang diterima tidak sesuai dengan tahun ajaran aktif'], 400);
        }
    }

    // end input nilai ekskul

    // input kenaikan siswa
    public function kenaikan()
    {
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = HistoryWakel::where('guru_id', $guruId)
        ->distinct()
        ->get(['tahun_ajaran']);

        return view('guru.kenaikan', compact('tahun'));
    }

    // show kenaikan siswa
    public function show_siswa_kenaikan(Request $request)
    {
        $tapel = $request->tapel;
        $t = TahunAjaran::where('tahun', $tapel)->first();
        $smt = $t->semester;
        $userData = session('userData');
        $guruId = $userData->user_id;

        $hw = HistoryWakel::where('guru_id', $guruId)
        ->where('tahun_ajaran', $tapel)->first();
        $classId = $hw->class_id;
        $k = Kelas::where('id', $classId)->first();
        $nama_kelas = $k->nama_rombel;

        $kenaikan = DB::table('users as u')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
        ->leftJoin('kenaikan as k', 'k.user_id', '=', 'u.id')
        ->where('u.role_id', 3)
        ->where('hs.class_id', $classId)
        ->where('k.tahun_ajaran', $tapel)
        ->count();

        if($kenaikan == 0)
        {
            $siswa = DB::table('users as u')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
            ->leftJoin('kenaikan as k', 'k.user_id', '=', 'u.id')
            ->select(
                'pd.nama',
                'pd.jenis_kelamin',
                DB::raw('CASE WHEN k.status_kenaikan IS NOT NULL THEN NULL ELSE k.status_kenaikan END AS status_kenaikan'),
                DB::raw('CASE WHEN k.deskripsi IS NOT NULL THEN NULL ELSE k.deskripsi END AS deskripsi'),
                'u.id as user_id'
            )
            ->where('u.role_id', 3)
            ->where('hs.class_id', $classId)
            ->orderBy('pd.nama', 'asc')
            ->get();
        }else{
            $siswa = DB::table('users as u')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->leftJoin('history_siswa as hs', 'hs.user_id', '=', 'u.id')
            ->leftJoin('kenaikan as k', 'k.user_id', '=', 'u.id')
            ->select(
                'pd.nama',
                'pd.jenis_kelamin',
                'k.status_kenaikan',
                'k.deskripsi',
                'u.id as user_id'
            )
            ->where('u.role_id', 3)
            ->where('hs.class_id', $classId)
            ->where('k.tahun_ajaran', $tapel)
            ->orderBy('pd.nama', 'asc')
            ->get();
        }

        return view('guru.show_kenaikan', compact('tapel', 'smt', 'classId', 'nama_kelas', 'siswa'));
    }

    // kirim catatan kenaikan
    public function kirim_catatan_wakel(Request $request)
    {
        $th = $request->tahun_ajaran;
        $user_id = $request->user_id;
        $status = $request->status;
        $catatan = $request->catatan;

        $tahunAktif = TahunAjaran::where('status', 'Y')->first();

        if($tahunAktif->tahun == $th)
        {
            foreach($user_id as $index => $userId)
            {
                $sts = $status[$index];
                $ct = $catatan[$index];

                $existing = Kenaikan::where('tahun_ajaran', $th)
                ->where('user_id', $userId)->first();

                if($existing)
                {
                    $existing->status_kenaikan = $sts;
                    $existing->deskripsi = $ct;
                    $existing->save();
                }else{
                    $k = new Kenaikan();
                    $k->id = rand().date('his');
                    $k->tahun_ajaran = $th;
                    $k->user_id = $userId;
                    $k->status_kenaikan = $sts;
                    $k->deskripsi = $ct;
                    $k->save();
                }
            }
            return response()->json(['message' => 'Catatan Wali Kelas berhasil disimpan atau diperbarui']);
        }else{
            return response()->json(['message' => 'Tahun ajaran yang diterima tidak sesuai dengan tahun ajaran aktif'], 400);
        }
    }

    // end input kenaikan

    // cetak raport page
    public function cetak_raport(){
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = HistoryWakel::where('guru_id', $guruId)
        ->distinct()
        ->get(['tahun_ajaran']);

        return view('guru.cetak_raport', compact('tahun'));
    }

    // view nama siswa
    public function show_siswa_raport(Request $request){
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tapel = $request->tapel;

        $hw = HistoryWakel::where('tahun_ajaran', $tapel)
        ->where('guru_id', $guruId)->first();
        $classId = $hw->class_id;

        $k = Kelas::where('id', $classId)->first();
        $nama_kelas = $k->nama_rombel;

        $siswa = DB::table('users')
        ->select('users.id as user_id', 'personal_data.nama', 'history_siswa.tahun_ajaran')
        ->join('personal_data', 'users.personal_id', '=', 'personal_data.id')
        ->join('history_siswa', 'history_siswa.user_id', '=', 'users.id')
        ->where('users.role_id', 3)
        ->where('history_siswa.class_id', $classId)
        ->where('history_siswa.tahun_ajaran', $tapel)
        ->orderBy('personal_data.nama', 'asc')
        ->get();

        return view('guru.show_raport', compact('siswa', 'tapel', 'nama_kelas'));
    }

    // cetak cover
    public function cetak_cover(Request $request)
    {
        $siswaId = $request->siswa_id;

        $s = DB::table('siswa as s')
        ->select('pd.nama', 's.nisn')
        ->join('users as u', 's.user_id', '=' ,'u.id')
        ->join('personal_data as pd', 'u.personal_id', '=' , 'pd.id')
        ->where('u.id', $siswaId)->first();

        $sch = ProfilSekolah::first();

        $pdf = PDF::loadView('cetak.cover', compact('s', 'sch'))
        ->setPaper('a4', 'potrait'); // Atur orientasi menjadi landscape

        // Tampilkan PDF di browser
        return $pdf->stream('Cover - ' . $s->nama . '.pdf');
    }

    // cetak profil sekolah
    public function cetak_profil_sekolah()
    {
        $sekolah = ProfilSekolah::first();

        $pdf = PDF::loadView('cetak.profil_sekolah', compact('sekolah'))
        ->setPaper('a4', 'potrait'); // Atur orientasi menjadi landscape

        // Tampilkan PDF di browser
        return $pdf->stream('Profil Sekolah - ' . $sekolah->nama_sekolah . '.pdf');
    }

    public function cetak_identitas(Request $request)
    {
        $siswaId = $request->siswa_id;

        $s = DB::table('siswa as s')
        ->select('s.*', 'pd.*')
        ->join('users as u', 's.user_id', '=' ,'u.id')
        ->join('personal_data as pd', 'u.personal_id', '=' , 'pd.id')
        ->where('u.id', $siswaId)->first();

        $sch = ProfilSekolah::first();
        $kepId = $sch->kep_id;

        $ks = DB::table('users')
        ->select('pd.nama')
        ->leftJoin('personal_data as pd', 'users.personal_id', '=', 'pd.id')
        ->where('users.id', $kepId)
        ->first();


        $pdf = PDF::loadView('cetak.identitas', compact('s', 'ks'))
        ->setPaper('a4', 'potrait'); // Atur orientasi menjadi landscape

        // Tampilkan PDF di browser
        return $pdf->stream('Profil Sekolah - ' .''. '.pdf');
    }

    // cetak raport siswa
    public function cetak_raport_siswa(Request $request)
    {
        $siswaId = $request->siswa_id;
        $tapel = $request->tapel;

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

        // return view('cetak.raport_siswa', compact('kel_a', 'kel_b', 'kel_c1','kel_c2','kel_c3', 'nilai', 'nama_kelas', 'siswaId', 'tapel', 'sekolah', 'siswa', 'tahun_ajaran', 'semester', 'smt', 'ns', 'kn', 'kt', 'e', 'ne', 'w', 'ks'));
    }

    // end cetak raport


    // cetak leger nilai
    public function cetak_leger()
    {
        $userData = session('userData');
        $guruId = $userData->user_id;
        $tahun = HistoryWakel::where('guru_id', $guruId)
        ->distinct()
        ->get(['tahun_ajaran']);

        return view('guru.cetak_leger', compact('tahun'));
    }

    public function cetak_leger_kelas(Request $request)
    {
        $tapel = $request->query('tapel');
        $userData = session('userData');
        $guruId = $userData->user_id;

        $hw = HistoryWakel::where('tahun_ajaran', $tapel)
            ->where('guru_id', $guruId)
            ->first();
        $classId = $hw->class_id;

        $k = Kelas::where('id', $classId)->first();
        $nama_kelas = $k->nama_rombel;

        $t = TahunAjaran::where('tahun', $tapel)->first();
        $semester = $t->semester;

        if($semester == 1)
        {
            $semester = "(Ganjil)";
        }else{
            $semester = "(Genap)";
        }
        // Mapel list kelompok a
        $kel_a = DB::select("
            SELECT m.kode
            FROM guru_mapel gm
            JOIN mapel m ON gm.mapel_id = m.id
            WHERE gm.class_id = ?
            AND m.kelompok = ?
            ORDER BY m.urutan ASC
        ", [$classId, 'A']);

        $kel_b = DB::select("
            SELECT m.kode
            FROM guru_mapel gm
            JOIN mapel m ON gm.mapel_id = m.id
            WHERE gm.class_id = ?
            AND m.kelompok = ?
            ORDER BY m.urutan ASC
        ", [$classId, 'B']);

        $kel_c1 = DB::select("
            SELECT m.kode
            FROM guru_mapel gm
            JOIN mapel m ON gm.mapel_id = m.id
            WHERE gm.class_id = ?
            AND m.kelompok = ?
            ORDER BY m.urutan ASC
        ", [$classId, 'C1']);

        $kel_c2 = DB::select("
            SELECT m.kode
            FROM guru_mapel gm
            JOIN mapel m ON gm.mapel_id = m.id
            WHERE gm.class_id = ?
            AND m.kelompok = ?
            ORDER BY m.urutan ASC
        ", [$classId, 'C2']);

        $kel_c3 = DB::select("
            SELECT m.kode
            FROM guru_mapel gm
            JOIN mapel m ON gm.mapel_id = m.id
            WHERE gm.class_id = ?
            AND m.kelompok = ?
            ORDER BY m.urutan ASC
        ", [$classId, 'C3']);

        $nilai = DB::table('users AS u')
            ->leftJoin('personal_data AS pd', 'u.personal_id', '=', 'pd.id')
            ->leftJoin('siswa AS s', 's.user_id', '=', 'u.id')
            ->leftJoin('history_siswa AS hs', 'hs.user_id', '=', 'u.id')
            ->leftJoin('nilai AS n', 'n.user_id', '=', 'u.id')
            ->leftJoin('mapel AS m', 'n.mapel_id', '=', 'm.id')
            ->select(
                'u.id AS user_id',
                'pd.nama',
                's.nisn',
                'm.kode',
                'n.nilai_pengetahuan',
                'n.nilai_keterampilan'
            )
            ->where('hs.tahun_ajaran', $tapel)
            ->where('hs.class_id', $classId)
            ->where('u.role_id', 3)
            ->get();

            $sekolah = ProfilSekolah::first();
            $nama_sekolah = $sekolah->nama_sekolah;

        // Buat PDF dari view 'guru' dengan data yang telah diambil
        $pdf = PDF::loadView('cetak.leger', compact('kel_a', 'kel_b', 'kel_c1', 'kel_c2', 'kel_c3', 'nilai', 'nama_kelas', 'semester', 'tapel', 'nama_sekolah'))
        ->setPaper('a4', 'landscape'); // Atur orientasi menjadi landscape

        // Tampilkan PDF di browser
        return $pdf->stream('Leger Nilai ' . $nama_kelas . '.pdf');
    }
}
