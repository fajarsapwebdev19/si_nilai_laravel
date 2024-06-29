<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Ekskul;
use App\Models\User;
use App\Models\Guru;
use App\Models\PersonalData;
use App\Models\Tingkat;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Ramsey\Uuid\Uuid;

class AdminController extends Controller
{
    public function index()
    {
        return view('index');
    }

    // manajemen akun

    public function account()
    {
        return view('account');
    }

    // data manajemen akun
    public function account_data(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with(['personalData', 'role'])->where('role_id', 1)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                            <button class="badge rounded-pill text-bg-info ubah" data-id="' . $row->id . '">Ubah</button>
                            <button class="badge rounded-pill text-bg-danger hapus" data-id="' . $row->id . '">Hapus</button>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status_account == "Y" ? '<em class="fas fa-check-circle text-success"></em>' : '<em class="fas fa-times-circle text-danger"></em>';
                    return $status;
                })
                ->rawColumns(['action', 'status'])
                ->toJson();
        }
    }

    // proses tambah data admin
    public function tambah_akun(Request $request)
    {
        $p_id = mt_rand();

        $personal = new PersonalData();
        $personal->id = $p_id;
        $personal->nama = $request->nama;
        $personal->jenis_kelamin = $request->jenis_kelamin;
        $personal->alamat = $request->alamat;
        $personal->create_at = date('Y-m-d H:i:s');
        $personal->modified_at = NULL;

        $user = new User();
        $user->id = Uuid::uuid4()->toString();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->real_password = $request->password;
        $user->status_account = 'Y';
        $user->role_id = 1;
        $user->personal_id = $p_id;
        $user->create_at = date('Y-m-d H:i:s');
        $user->modified_at = NULL;

        $personal->save();
        $user->save();

        return response()->json(['message' => 'Berhasil Tambah Akun Admin'], 200);
    }

    // ambil data untuk edit data akun admin
    public function get_users_edit($id)
    {
        $user = User::with(['personalData', 'role'])->find($id);

        return view('modals.editaccount', compact('user'));
    }

    // ambil data untuk hapus data akun admin
    public function get_users_delete($id)
    {
        $user = User::with(['personalData', 'role'])->find($id);

        return view('modals.confirmdeleteaccount', compact('user'));
    }

    // proses ubah data akun admin
    public function ubah_akun(Request $request, $id)
    {
        $user = User::with(['personalData', 'role'])->find($id);

        $personal = PersonalData::find($user->personal_id);
        $personal->nama = $request->nama;
        $personal->jenis_kelamin = $request->jenis_kelamin;
        $personal->alamat = $request->alamat;
        $personal->modified_at = date('Y-m-d H:i:s');
        $personal->save();

        $user->password = Hash::make($request->password);
        $user->real_password = $request->password;
        $user->modified_at = date('Y-m-d H:i:s');
        $user->save();


        return response()->json(['message' => 'Berhasil Ubah Akun Admin'], 200);
    }

    // proses hapus akun
    public function hapus_akun($id)
    {
        $user = User::with(['personalData', 'role'])->find($id);
        $personal = PersonalData::find($user->personal_id);
        $user->delete();
        $personal->delete();
        return response()->json(['message' => 'Berhasil Hapus Akun Admin'], 200);
    }

    // guru
    public function teacher()
    {
        return view('teacher');
    }

    // sensor nik
    public function sensorNik($nik, $mask_char = '*', $num_visible_start = 6, $num_visible_end = 6)
    {
        $start = substr($nik, 0, $num_visible_start);
        $end = substr($nik, -$num_visible_end);
        $masked_length = strlen($nik) - ($num_visible_start + $num_visible_end);
        $masked = str_repeat($mask_char, $masked_length);

        return $start . $masked . $end;
    }

    // generate acak untuk username dan password
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($characters, ceil($length / strlen($characters)))), 1, $length);
    }

    // data guru
    public function data_guru(Request $request)
    {
        if ($request->ajax()) {
            // Ambil data User dengan relasi 'personalData' dan 'guru' yang memiliki role_id = 2
            $data = User::with(['personalData', 'guru'])
            ->where('role_id', 2)
            ->get();

            // Menggunakan DataTables untuk mengubah data menjadi format JSON yang sesuai
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nik', function ($row) {
                    // Memeriksa apakah relasi 'guru' ada sebelum mengakses properti 'nik'
                    return $row->guru->nik ? $this->sensorNik($row->guru->nik) : 'NULL';
                })
                ->addColumn('action', function ($row) {
                    // Tombol aksi untuk setiap baris data
                    $btn = '<button class="badge rounded-pill text-bg-info ubah" data-id="' . $row->id . '">Ubah</button> ';
                    $btn .= '<button class="badge rounded-pill text-bg-danger hapus" data-id="' . $row->id . '">Hapus</button>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    // Kolom status dengan ikon berdasarkan nilai 'status_account'
                    return $row->status_account == "Y" ? '<em class="fas fa-check-circle text-success"></em>' : '<em class="fas fa-times-circle text-danger"></em>';
                })
                ->rawColumns(['action', 'nik', 'status']) // Menandakan kolom yang berisi HTML
                ->toJson(); // Mengonversi data menjadi format JSON
        }
    }


    // proses tambah data
    public function tambah_guru(Request $request)
    {
        DB::beginTransaction();

        $p_id = mt_rand(0, 99999);
        $personal = new PersonalData();
        $personal->id = $p_id;
        $personal->nama = $request->nama;
        $personal->jenis_kelamin = $request->jenis_kelamin;
        $personal->alamat = $request->alamat;
        $personal->create_at = date('Y-m-d H:i:s');
        $personal->save();

        $user = new User();
        $uid = Uuid::uuid4()->toString();
        $user->id = $uid;
        $user->username = $this->generateRandomString(6);
        $user->password = Hash::make($this->generateRandomString(6));
        $user->real_password = $this->generateRandomString(6);
        $user->status_account = 'Y';
        $user->role_id = 2;
        $user->personal_id = $p_id;
        $user->create_at = date('Y-m-d H:i:s');
        $user->modified_at = NULL;
        $user->save();

        $guru = new Guru();
        $guru->nik = $request->nik;
        $guru->nuptk = $request->nuptk;
        $guru->tempat_lahir = $request->t_lahir;
        $guru->tanggal_lahir = $request->tgl_lahir;
        $guru->jenis_ptk = $request->jenis_ptk;
        $guru->wali_kelas = NULL;
        $guru->class_id = NULL;
        $guru->user_id = $uid;
        $guru->save();

        DB::commit();

        return response()->json(['message' => 'Berhasil Tambah Data Guru'], 200);
    }

    // ambil data guru untuk ditampilkan kedalam form edit
    public function get_teacher_edit($id)
    {
        $t = User::with('personalData', 'guru')->find($id);
        $k = Kelas::where('status', 'y')->get();

        return view('modals.editguru', compact('t', 'k'));
    }

    // ambil id data guru untuk ditampilkan kedalam form konfirmasi hapus data
    public function get_teacher_delete($id)
    {
        $t = User::with('personalData', 'guru')->find($id);

        return view('modals.confirmdeleteguru', compact('t'));
    }

    // proses ubah data guru
    public function ubah_guru(Request $request, $id)
    {
        DB::beginTransaction();

        $u = User::with('personalData', 'guru')->find($id);

        $guru = Guru::where('user_id', $id)->first();
        $guru->nik = $request->nik;
        $guru->nuptk = $request->nuptk;
        $guru->tempat_lahir = $request->t_lahir;
        $guru->tanggal_lahir = $request->tgl_lahir;
        $guru->jenis_ptk = $request->jenis_ptk;
        $guru->save();

        $personal = PersonalData::find($u->personal_id);
        $personal->nama = $request->nama;
        $personal->jenis_kelamin = $request->jenis_kelamin;
        $personal->alamat = $request->alamat;
        $personal->modified_at = date('Y-m-d H:i:s');
        $personal->save();

        $u->password = Hash::make($request->password);
        $u->real_password = $request->password;
        $u->modified_at = date('Y-m-d H:i:s');
        $u->save();

        DB::commit();


        return response()->json(['message' => 'Berhasil memperbarui data guru'], 200);
    }

    // proses hapus data guru
    public function hapus_guru($id)
    {
        $user = User::with('personalData', 'guru')->find($id);

        $t = Guru::where('user_id', $user->id);
        $t->delete();

        $p = PersonalData::find($user->personal_id);
        $p->delete();

        $user->delete();

        return response()->json(['message' => 'Berhasil Hapus Data Guru'], 200);
    }

    // get tingkat
    public function get_tingkat(){
        $tingkat = Tingkat::all();

        return response()->json($tingkat);
    }

    // get data siswa dari id class
    public function get_siswa_tingkat(Request $request){
        $id = $request->id;
        $kelas = Kelas::where('id', $id)->first();
        $tingkat = $kelas->tingkat;

        $siswa = DB::table('users as u')
        ->select('u.*', 'pd.*', 's.*', 'ks.*', 'k.*')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->leftJoin('siswa as s', 's.user_id', '=', 'u.id')
        ->leftJoin('kelas_siswa as ks', 'ks.user_id', '=', 'u.id')
        ->leftJoin('kelas as k', 'ks.class_id', '=', 'k.id')
        ->where('u.role_id', 3)
        ->where('s.tingkat', $tingkat)
        ->where('ks.class_id', NULL)
        ->get();

        return DataTables::of($siswa)
        ->addColumn('checkbox', function($row) {
            return '<input type="checkbox" class="form-check-input no-class-siswa" data-id="' . $row->user_id . '">';
        })
        ->rawColumns(['checkbox'])
        ->toJson();
    }

    public function get_siswa_class(Request $request)
    {
        $id = $request->id;
        $kelas = Kelas::where('id', $id)->first();
        $tingkat = $kelas->tingkat;

        $siswa = DB::table('users as u')
        ->select('u.*', 'pd.*', 's.*', 'ks.*', 'k.*')
        ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
        ->leftJoin('siswa as s', 's.user_id', '=', 'u.id')
        ->leftJoin('kelas_siswa as ks', 'ks.user_id', '=', 'u.id')
        ->leftJoin('kelas as k', 'ks.class_id', '=', 'k.id')
        ->where('u.role_id', 3)
        ->where('s.tingkat', $tingkat)
        ->where('ks.class_id', $kelas->id)
        ->get();

        return DataTables::of($siswa)
        ->addColumn('checkbox', function($row) {
            return '<input type="checkbox" class="form-check-input siswa" data-id="' . $row->user_id . '">';
        })
        ->rawColumns(['checkbox'])
        ->toJson();
    }

    public function send_student_class(Request $request){
        $id = $request->user_id;
        $newClassId = $request->input('class_id');

        $kelas_siswa = KelasSiswa::wherein('user_id', $id)->get();

        foreach($kelas_siswa as $ks)
        {
            $ks->class_id = $newClassId;
            $ks->save();
        }

        return response()->json(['message' => 'Berhasil Tambah Siswa Kedalam Kelas'], 200);
    }

    public function drop_student_class(Request $request){
        $id = $request->user_id;
        $newClassId = NULL;

        $kelas_siswa = KelasSiswa::wherein('user_id', $id)->get();

        foreach($kelas_siswa as $ks)
        {
            $ks->class_id = $newClassId;
            $ks->save();
        }

        return response()->json(['message' => 'Berhasil Menghapus Kelas Siswa'], 200);
    }

    // siswa
    public function student()
    {
        return view('student');
    }

    // data siswa
    public function data_siswa(Request $request)
    {
        if($request->ajax())
        {
            $siswa = User::with(['personalData', 'siswa'])
            ->where('role_id', 3)
            ->get();

            return DataTables::of($siswa)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
            return '<button class="badge rounded-pill text-bg-info ubah" data-id="' . $row->id . '">Ubah</button>
            <button class="badge rounded-pill text-bg-danger hapus" data-id="' . $row->id . '">Hapus</button>';
            })
            ->rawColumns(['action'])
            ->toJson();
        }
    }

    // proses tambah data siswa
    public function tambah_siswa(Request $request)
    {
        // id untuk personal id siswa
        $p_id = mt_rand(1111,5555).rand(0,999);

        DB::beginTransaction();
        // personal data
        $personal = new PersonalData();
        $personal->id = $p_id;
        $personal->nama = $request->nama;
        $personal->jenis_kelamin = $request->jenis_kelamin;
        $personal->alamat = $request->alamat;
        $personal->create_at = date('Y-m-d H:i:s');
        $personal->modified_at = NULL;
        $personal->save();

        // users
        $user = new User();
        $uid =  Uuid::uuid4()->toString();
        $user->id = $uid;
        $user->username = $request->nisn;
        $user->password = Hash::make($this->generateRandomString(6));
        $user->real_password = $this->generateRandomString(6);
        $user->status_account = 'Y';
        $user->role_id = 3;
        $user->personal_id = $p_id;
        $user->create_at = date('Y-m-d H:i:s');
        $user->modified_at = NULL;
        $user->save();

        // kelas siswa
        $kelas_siswa = new KelasSiswa();
        $kelas_siswa->user_id = $uid;
        $kelas_siswa->class_id = NULL;
        $kelas_siswa->save();

        // siswa
        $siswa = new Siswa();
        $siswa->nisn = $request->nisn;
        $siswa->nik = $request->nik;
        $siswa->tempat_lahir = $request->t_lhr;
        $siswa->tanggal_lahir = $request->tgl_lhr;
        $siswa->agama = $request->agama;
        $siswa->rt = $request->rt;
        $siswa->rw = $request->rw;
        $siswa->kelurahan = $request->kelurahan;
        $siswa->kecamatan = $request->kecamatan;
        $siswa->kode_pos = $request->kode_pos;
        $siswa->anak_ke = $request->anak_ke;
        $siswa->nama_ayah = $request->nama_ayah;
        $siswa->pendidikan_ayah = $request->pendidikan_ayah;
        $siswa->pekerjaan_ayah = $request->pekerjaan_ayah;
        $siswa->nama_ibu = $request->nama_ibu;
        $siswa->pendidikan_ibu = $request->pendidikan_ibu;
        $siswa->pekerjaan_ibu = $request->pekerjaan_ibu;
        $siswa->user_id = $uid;
        $siswa->tingkat = $request->tingkat;
        $siswa->save();

        DB::commit();

        return response()->json(['message' => 'Berhasil tambah data siswa'], 200);
    }

    public function ubah_siswa(Request $request, $id)
    {
        $s = User::with('personalData', 'siswa')->find($id);
        $p_id = $s->personal_id;

        $siswa = Siswa::where('user_id', $id)->first();
        $siswa->nisn = $request->nisn;
        $siswa->nik = $request->nik;
        $siswa->tempat_lahir = $request->t_lahir;
        $siswa->tanggal_lahir = $request->tgl_lahir;
        $siswa->agama = $request->agama;
        $siswa->rt = $request->rt;
        $siswa->rw = $request->rw;
        $siswa->kelurahan = $request->kelurahan;
        $siswa->kecamatan = $request->kecamatan;
        $siswa->kode_pos = $request->kode_pos;
        $siswa->anak_ke = $request->anak_ke;
        $siswa->nama_ayah = $request->nama_ayah;
        $siswa->pendidikan_ayah = $request->pendidikan_ayah;
        $siswa->pekerjaan_ayah = $request->pekerjaan_ayah;
        $siswa->nama_ibu = $request->nama_ibu;
        $siswa->pendidikan_ibu = $request->pendidikan_ibu;
        $siswa->pekerjaan_ibu = $request->pekerjaan_ibu;
        $siswa->tingkat = $request->tingkat;
        $siswa->save();


        $personal = PersonalData::find($p_id);
        $personal->nama = $request->nama;
        $personal->jenis_kelamin = $request->jenis_kelamin;
        $personal->alamat = $request->alamat;
        $personal->save();

        return response()->json(['message' => 'Berhasil ubah data siswa'], 200);
    }

    // get siswa by id
    public function get_siswa($id)
    {
        $siswa = User::with('personalData', 'siswa')->find($id);

        return response()->json($siswa);
    }

    // class
    public function class_room()
    {
        return view('class');
    }

    // data kelas
    public function get_data_kelas()
    {
        $kelas = Kelas::where('status', 'y')->get();
        return response()->json($kelas);
    }

    public function data_kelas(Request $request)
    {
        if ($request->ajax()) {
            $data = Kelas::orderBy('nama_rombel', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" class="badge rounded-pill text-bg-primary siswa" id="'.$row->nama_rombel.'" data-id="' . $row->id . '">Siswa</button> <button type="button" class="badge rounded-pill text-bg-info ubah" data-id="' . $row->id . '">Ubah</button> <button type="button" class="badge rounded-pill text-bg-danger hapus" data-id="' . $row->id . '">Hapus</button>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status == 'y' ? "<em class='fas fa-check-circle text-success'></em>" : "<em class='fas fa-times-circle text-danger'></em>";
                    return $status;
                })
                ->rawColumns(['action', 'status'])
                ->toJson();
        }
    }

    // proses tambah data kelas
    public function tambah_kelas(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_rombel' => 'required|string|max:255',
            'tingkat' => 'required|integer',
            'status' => 'required|in:y,n', // contoh validasi status
            // tambahkan validasi sesuai kebutuhan lainnya
        ]);

        // Simpan data ke dalam tabel kelas
        $kelas = new Kelas();
        $kelas->id = Uuid::uuid4()->toString();
        $kelas->nama_rombel = $request->nama_rombel;
        $kelas->tingkat = $request->tingkat;
        $kelas->status = $request->status;
        $kelas->save();

        // Berikan respons JSON yang menyatakan berhasil simpan data
        return response()->json(['message' => 'Berhasil Simpan Data Kelas'], 200);
    }

    // ambil data kelas berdasarkan id untuk di tampilkan kedalam modal edit kelas
    public function get_class($id)
    {
        // Menggunakan findOrFail untuk mencari kelas berdasarkan ID
        $kelas = Kelas::findOrFail($id);

        // Mengirimkan data $kelas ke view 'modals.editclass' dengan compact
        return view('modals.editclass', compact('kelas'));
    }

    public function get_class_delete($id)
    {
        // Mengambil hanya kolom 'id' dan 'nama_rombel'
        $kelas = Kelas::select('id', 'nama_rombel')->findOrFail($id);

        return view('modals.confirmdeleteclass', compact('kelas'));
    }

    // proses ubah data kelas
    public function ubah_kelas(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->nama_rombel = $request->nama_rombel;
        $kelas->tingkat = $request->tingkat;
        $kelas->status = $request->status;
        $kelas->save();

        return response()->json(['message' => 'Berhasil Ubah Data Kelas'], 200);
    }

    // proses hapus data
    public function hapus_kelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return response()->json(['message' => 'Berhasil Hapus Data Kelas'], 200);
    }

    // mapel
    public function mapel()
    {
        return view('mapel');
    }

    // data mapel
    public function data_mapel(Request $request)
    {
        if ($request->ajax()) {
            $data = Mapel::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="badge rounded-pill text-bg-info ubah" data-id="' . $row->id . '">Ubah</button>
                <button class="badge rounded-pill text-bg-danger hapus" data-id="' . $row->id . '">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    // tambah data mapel
    public function tambah_mapel(Request $request)
    {
        $mapel = new Mapel();
        $mapel->id = Uuid::uuid4()->toString();
        $mapel->kelompok = $request->kelompok;
        $mapel->kode = $request->kode;
        $mapel->nama_mapel = $request->nama_mapel;
        $mapel->tingkat = $request->tingkat;
        $mapel->kkm = $request->kkm;
        $mapel->save();

        return response()->json(['message' => 'Berhasil Tambah Data Mapel'], 200);
    }

    // ambil data mapel per id
    public function get_data_mapel($id)
    {
        $mapel = Mapel::findOrFail($id);

        return view("modals.update_mapel", compact("mapel"));
    }
    public function get_mapel_delete($id)
    {
        $mapel = Mapel::findOrFail($id);

        return view("modals.confirmdeletemapel", compact("mapel"));
    }

    // proses ubah data mapel
    public function ubah_mapel(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->kelompok = $request->kelompok;
        $mapel->kode = $request->kode;
        $mapel->nama_mapel = $request->nama_mapel;
        $mapel->tingkat = $request->tingkat;
        $mapel->kkm = $request->kkm;
        $mapel->save();

        return response()->json(['message' => 'Berhasil Ubah Data Mapel'], 200);
    }

    // proses hapus data
    public function hapus_mapel($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return response()->json(['message' => 'Berhasil Hapus Data Mapel'], 200);
    }

    // ekskul

    public function ekskul()
    {
        return view('ekskul');
    }
    // data ekskul
    public function data_ekskul(Request $request)
    {
        if ($request->ajax()) {
            $data = Ekskul::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="badge rounded-pill text-bg-info ubah" data-id="' . $row->id . '">Ubah</button>
                <button class="badge rounded-pill text-bg-danger hapus" data-id="' . $row->id . '">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }
    // proses tambah ekskul
    public function tambah_ekskul(Request $request)
    {
        $ekskul = new Ekskul();
        $ekskul->id = Uuid::uuid4()->toString();
        $ekskul->nama_ekstrakulikuler = $request->nama_ekstrakulikuler;
        $ekskul->save();

        return response()->json(['message' => 'Berhasil Tambah Data Ekskul'], 200);
    }

    // ambil data per id data ekskul untuk edit data dan konfirmasi hapus data
    public function get_ekskul_delete($id)
    {
        $ekskul = Ekskul::findOrFail($id);

        return view('modals.confirmdeleteekskul', compact('ekskul'));
    }
    public function get_ekskul_edit($id)
    {
        $ekskul = Ekskul::findOrFail($id);

        return view('modals.editekskul', compact('ekskul'));
    }

    // proses ubah data ekskul
    public function ubah_ekskul(Request $request, $id)
    {
        $ekskul = Ekskul::findOrFail($id);
        $ekskul->nama_ekstrakulikuler = $request->nama_ekstrakulikuler;
        $ekskul->save();
        return response()->json(['message' => 'Berhasil Ubah Data Ekskul'], 200);
    }

    // proses hapus data ekskul
    public function hapus_ekskul($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        $ekskul->delete();
        return response()->json(['message' => 'Berhasil Hapus Data Ekskul'], 200);
    }

    public function set_profil()
    {
        return view('set_profile');
    }

    public function set_wakel()
    {
        return view('set_wakel');
    }

    public function set_mapel()
    {
        return view('set_mapel');
    }
}
