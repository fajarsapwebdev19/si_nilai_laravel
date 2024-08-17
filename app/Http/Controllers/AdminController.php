<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\TahunAjaran;
use App\Models\HistorySiswa;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Ekskul;
use App\Models\User;
use App\Models\Guru;
use App\Models\PersonalData;
use App\Models\Tingkat;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\ProfilSekolah;
use App\Models\Kejuruan;
use App\Models\GuruMapel;
use App\Models\Info;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\DataTables;
use Ramsey\Uuid\Uuid;

class AdminController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all()->count();
        $guru = Guru::all()->count();
        $kelas = Kelas::all()->count();
        $pengguna = User::all()->count();
        return view('index', compact('siswa', 'guru', 'kelas', 'pengguna'));
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

    // kejuruan

    public function kejuruan()
    {
        return view('kejuruan');
    }

    // data kejuruan
    public function data_kejuruan(Request $request)
    {
        if($request->ajax())
        {
            $data = Kejuruan::orderBy('nama_kejuruan', 'asc');

            // Menggunakan DataTables untuk mengubah data menjadi format JSON yang sesuai
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Tombol aksi untuk setiap baris data
                    $btn = '<button class="badge rounded-pill text-bg-info ubah" data-id="' . $row->id . '">Ubah</button> ';
                    $btn .= '<button class="badge rounded-pill text-bg-danger hapus" data-id="' . $row->id . '">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action']) // Menandakan kolom yang berisi HTML
                ->toJson(); // Mengonversi data menjadi format JSON
        }
    }

    public function tambah_kejuruan(Request $request)
    {
        $k = new Kejuruan();
        $k->id = Uuid::uuid4();
        $k->nama_kejuruan = $request->nama_kejuruan;
        $k->save();

        return response()->json(['message' => 'Berhasil Tambah Data Kejuruan'], 200);
    }

    public function get_kejuruan($id)
    {
        $k = Kejuruan::where('id', $id)->first();

        return response()->json($k);
    }

    public function ubah_kejuruan($id, Request $request)
    {
        $k = Kejuruan::where('id', $id)->first();

        $k->nama_kejuruan = $request->nama_kejuruan;
        $k->save();

        return response()->json(['message' => 'Berhasil Ubah Data Kejuruan'], 200);
    }

    public function hapus_kejuruan($id)
    {
        $k = Kejuruan::where('id', $id)->first();

        // Check if the kejuruan is associated with any kelas
        $kelasCount = Kelas::where('jurusan_id', $id)->count();

        if ($kelasCount > 0) {
            return response()->json(['error' => 'Tidak dapat menghapus Kejuruan karena masih terkait dengan Kelas'], 400);
        }

        $k->delete();
        return response()->json(['message' => 'Berhasil Hapus Data Kejuruan'], 200);
    }

    public function get_jurusan()
    {
        $k = Kejuruan::orderBy('nama_kejuruan', 'asc')->get();

        return response()->json($k);
    }

    public function import_kejuruan(Request $request)
    {
        $rules = [
            'file' => 'required|file|mimes:xlsx',
        ];

        $messages = [
            'file.required' => 'File harus diunggah',
            'file.file' => 'File yang diunggah harus berupa file',
            'file.mimes' => 'File yang diunggah harus berformat xlsx'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $path = $file->getRealPath();

        // spreadsheet
        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        array_shift($rows);
        $count = 0;
        DB::beginTransaction();
        foreach($rows as $r){
            $uuid = Uuid::uuid4();
            $nama_jurusan = $r[0];

            $kejuruan = new Kejuruan();
            $kejuruan->id = $uuid;
            $kejuruan->nama_kejuruan = $nama_jurusan;
            $kejuruan->save();

            $count++;
        }
        DB::commit();

        return response()->json(['message' => 'Berhasil Menambah '. $count .' Data Kejuruan'], 200);
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
        $guru->wali_kelas = 'N';
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
        DB::beginTransaction();

        $user = User::with('personalData', 'guru')->find($id);

        $t = Guru::where('user_id', $user->id);
        $t->delete();

        $p = PersonalData::find($user->personal_id);
        $p->delete();

        $user->delete();

        DB::commit();

        return response()->json(['message' => 'Berhasil Hapus Data Guru'], 200);
    }

    // import data guru
    public function import_guru(Request $request)
    {
        $rules = [
            'file' => 'required|file|mimes:xlsx',
        ];

        $messages = [
            'file.required' => 'File harus diunggah',
            'file.file' => 'File yang diunggah harus berupa file',
            'file.mimes' => 'File yang diunggah harus berformat xlsx'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $path = $file->getRealPath();

        // spreadsheet
        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        array_shift($rows);
        DB::beginTransaction();

        $count = 0;

        foreach($rows as $r)
        {
            $pid = mt_rand(0,9999).date('dmY');
            $username = $this->GenerateRandomNumber();
            $password = $this->generateRandomString(6);
            $nama = $r[0];
            $jk = $r[1];
            $nik = $r[2];
            $nuptk = $r[3];
            $tempat_lahir = $r[4];
            $tanggal_lahir = $r[5];
            $alamat = $r[6];
            $jenis_gtk = $r[7];
            $user_id = Uuid::uuid4();

            $pd = new PersonalData();
            $pd->id = $pid;
            $pd->nama = $nama;
            $pd->jenis_kelamin = $jk;
            $pd->alamat = $alamat;
            $pd->create_at = date('Y-m-d H:i:s');
            $pd->modified_at = NULL;
            $pd->save();

            $user = new User();
            $user->id = $user_id;
            $user->username = $username;
            $user->password = Hash::make($password);
            $user->real_password = $password;
            $user->status_account = "Y";
            $user->role_id = 2;
            $user->personal_id = $pid;
            $user->create_at = date('Y-m-d H:i:s');
            $user->modified_at = NULL;
            $user->save();

            $guru = new Guru();
            $guru->nik = $nik;
            $guru->nuptk = $nuptk;
            $guru->tempat_lahir = $tempat_lahir;
            $guru->tanggal_lahir = $tanggal_lahir;
            $guru->jenis_ptk = $jenis_gtk;
            $guru->wali_kelas = "N";
            $guru->class_id = NULL;
            $guru->user_id = $user_id;
            $guru->save();

            $count++;
        }

        DB::commit();

        return response()->json(['message' => 'Berhasil Tambah ' . $count . ' Data Guru'], 200);
    }

    // get tingkat
    public function get_tingkat(){
        $tingkat = Tingkat::all();

        return response()->json($tingkat);
    }

    // get data siswa dari id class
    public function get_siswa_tingkat(Request $request)
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
        ->where('ks.class_id', NULL)
        ->where('s.status', 'y')
        ->orderBy('pd.nama', 'asc')
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
        ->where('s.status', 'y')
        ->orderBy('pd.nama', 'asc')
        ->get();

        return DataTables::of($siswa)
        ->addColumn('checkbox', function($row) {
            return '<input type="checkbox" class="form-check-input siswa" data-id="' . $row->user_id . '">';
        })
        ->rawColumns(['checkbox'])
        ->toJson();
    }

    public function send_student_class(Request $request)
    {
        DB::beginTransaction();

        $id = $request->user_id;
        $newClassId = $request->input('class_id');

        $kelas_siswa = KelasSiswa::wherein('user_id', $id)->get();

        foreach($kelas_siswa as $ks)
        {
            $ks->class_id = $newClassId;
            $ks->save();
        }

        $ta = TahunAjaran::where("status", "Y")->first();
        $ta_active = $ta->tahun;

        foreach($id as $siswa_id)
        {
            $hs = new HistorySiswa();
            $hs->id = rand(11111, 99999).date('dmYhis');
            $hs->tahun_ajaran = $ta_active;
            $hs->class_id = $newClassId;
            $hs->user_id = $siswa_id;
            $hs->save();
        }

        DB::commit();

        return response()->json(['message' => 'Berhasil Tambah Siswa Kedalam Kelas'], 200);
    }

    public function drop_student_class(Request $request)
    {
        DB::beginTransaction();

        $id = $request->user_id;
        $newClassId = NULL;

        $kelas_siswa = KelasSiswa::wherein('user_id', $id)->get();

        foreach($kelas_siswa as $ks)
        {
            $ks->class_id = $newClassId;
            $ks->save();
        }

        $siswa_id = array_unique($id);

        $siswa = HistorySiswa::wherein('user_id', $siswa_id)->get();

        foreach($siswa as $s)
        {
            $s->delete();
        }

        DB::commit();

        return response()->json(['message' => 'Berhasil Menghapus Kelas Siswa'], 200);
    }

    // siswa
    public function student()
    {
        $keahlian = Kejuruan::orderBy('nama_kejuruan', 'asc')->get();
        return view('student', compact('keahlian'));
    }

    public function GenerateRandomNumber($length = 7)
    {
        $digits = '';
        for($i=0; $i < $length; $i++)
        {
            $digits .= mt_rand(0, 9);
        }
        return $digits;
    }

    // import siswa
    public function import_siswa(Request $request)
    {
        // Definisikan aturan validasi dan pesan kustom
        $rules = [
            'file' => 'required|file|mimes:xlsx'
        ];

        $messages = [
            'file.required' => 'File harus diunggah',
            'file.file' => 'File yang diunggah harus berupa file',
            'file.mimes' => 'File yang diunggah harus berformat .xlsx',
        ];

        // Lakukan validasi
        $validator = Validator::make($request->all(), $rules, $messages);

        // Jika validasi gagal, kembalikan pesan kesalahan dalam format JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $file = $request->file('file');
        $path = $file->getRealPath();

        // spreadsheet
        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        array_shift($rows);

        $count = 0;

        DB::beginTransaction();

        foreach($rows as $r)
        {
            $pid = rand(1,999).date('dmY');
            $uuid = Uuid::uuid4();
            $pwd = $this->generateRandomString(6);
            $nama = $r[0];
            $jk = $r[1];
            $nik = $r[2];
            $nisn = $r[3];
            $tempat_lahir = $r[4];
            $tanggal_lahir = $r[5];
            $alamat = $r[6];
            $rt = $r[7];
            $rw = $r[8];
            $kelurahan = $r[9];
            $kecamatan = $r[10];
            $kodepos = $r[11];
            $anakke = $r[12];
            $agama = $r[13];
            $nama_ayah = $r[14];
            $pendidikan_ayah = $r[15];
            $pekerjaan_ayah = $r[16];
            $nama_ibu = $r[17];
            $pendidikan_ibu = $r[18];
            $pekerjaan_ibu = $r[19];
            $tingkat = $r[20];

            $personal = new PersonalData();
            $personal->id = $pid;
            $personal->nama = $nama;
            $personal->jenis_kelamin = $jk;
            $personal->alamat = $alamat;
            $personal->create_at = date('Y-m-d H:i:s');
            $personal->modified_at = NULL;
            $personal->save();

            $user = new User();
            $user->id = $uuid;
            $user->username = $nisn;
            $user->password = Hash::make($pwd);
            $user->real_password = $pwd;
            $user->status_account = 'Y';
            $user->role_id = 3;
            $user->personal_id = $pid;
            $user->create_at = date('Y-m-d H:i:s');
            $user->modified_at = NULL;
            $user->save();

            $ks = new KelasSiswa();
            $ks->user_id = $uuid;
            $ks->class_id = NULL;
            $ks->save();

            $jurusan = Kejuruan::where('nama_kejuruan', 'like', '%' . $r[21] . '%')->first();

            $siswa = new Siswa();
            $siswa->nisn = $nisn;
            $siswa->nik = $nik;
            $siswa->tempat_lahir = $tempat_lahir;
            $siswa->tanggal_lahir = $tanggal_lahir;
            $siswa->agama = $agama;
            $siswa->rt = $rt;
            $siswa->rw = $rw;
            $siswa->kelurahan = $kelurahan;
            $siswa->kecamatan = $kecamatan;
            $siswa->kode_pos = $kodepos;
            $siswa->anak_ke = $anakke;
            $siswa->nama_ayah = $nama_ayah;
            $siswa->pendidikan_ayah = $pendidikan_ayah;
            $siswa->pekerjaan_ayah = $pekerjaan_ayah;
            $siswa->nama_ibu = $nama_ibu;
            $siswa->pendidikan_ibu = $pendidikan_ibu;
            $siswa->pekerjaan_ibu = $pekerjaan_ibu;
            $siswa->tingkat = $tingkat;
            $siswa->jurusan_id = $jurusan->id;
            $siswa->status = 'y';
            $siswa->user_id = $uuid;
            $siswa->save();

            $count++;
        }

        DB::commit();

        return response()->json(['message' => 'Berhasil Menambah '. $count .' Data Siswa'], 200);
    }

    // data siswa
    public function data_siswa(Request $request)
    {
        if($request->ajax())
        {
            $siswa = User::with(['personalData', 'siswa'])
            ->where('role_id', 3)
            ->whereHas('siswa', function($query){
                $query->where('status', 'y');
            })
            ->orderBy(function($query) {
                $query->select('nama')
                      ->from('personal_data')
                      ->whereColumn('personal_data.id', 'users.personal_id')
                      ->limit(1);
            }, 'asc')
            ->get();

            return DataTables::of($siswa)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
            return '<button class="badge rounded-pill text-bg-info ubah" data-id="' . $row->id . '">Ubah</button>
            <button class="badge rounded-pill text-bg-danger hapus" id="'.$row->personalData->nama.'" data-id="' . $row->id . '">Hapus</button>';
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
        $siswa->jurusan_id = $request->jurusan;
        $siswa->status = 'y';
        $siswa->save();

        DB::commit();

        return response()->json(['message' => 'Berhasil tambah data siswa'], 200);
    }

    public function ubah_siswa(Request $request, $id)
    {
        $s = User::with('personalData', 'siswa')->find($id);
        $p_id = $s->personal_id;

        $personal = PersonalData::find($p_id);
        $personal->nama = $request->nama;
        $personal->jenis_kelamin = $request->jenis_kelamin;
        $personal->alamat = $request->alamat;
        $personal->save();

        $siswa = Siswa::where('user_id', $id)->first();
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
        $siswa->tingkat = $request->tingkat;
        $siswa->jurusan_id = $request->jurusan;
        $siswa->save();
        return response()->json(['message' => 'Berhasil ubah data siswa'], 200);
    }

    public function hapus_siswa($id)
    {
        $user = User::find($id);

        $personal = PersonalData::find($user->personal_id);

        $ks = KelasSiswa::where('user_id', $id)->first();

        $s = Siswa::where('user_id', $id)->first();

        DB::beginTransaction();

        if($ks->class_id)
        {
            return response()->json(['message' => 'Hapus data siswa gagal karena siswa masih memiliki kelas'], 400);
        }else{
            $personal->delete();
            $s->delete();
            $ks->delete();
            $user->delete();
        }

        DB::commit();

        return response()->json(['message' => 'Berhasil hapus siswa'], 200);
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
        $k = Kejuruan::orderBy('nama_kejuruan', 'asc')->get();

        return view('class', compact('k'));
    }

    public function data_kelas(Request $request)
    {
        if ($request->ajax()) {
            $data = Kelas::with('jurusan')->orderBy('nama_rombel', 'asc')->get();

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
        $kelas->jurusan_id = $request->jurusan;
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
        $kejuruan = Kejuruan::orderBy('nama_kejuruan', 'asc')->get();

        // Mengirimkan data $kelas ke view 'modals.editclass' dengan compact
        return view('modals.editclass', compact('kelas', 'kejuruan'));
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
        $kelas->jurusan_id = $request->jurusan;
        $kelas->status = $request->status;
        $kelas->save();

        return response()->json(['message' => 'Berhasil Ubah Data Kelas'], 200);
    }

    // proses hapus data
    public function hapus_kelas($id)
    {
        $s = KelasSiswa::where('class_id', $id)->count();

        if($s > 0)
        {
            return response()->json(['message' => 'Kelas tidak dapat di hapus karena masih terdapat siswa di dalamnya'], 400);
        }
        DB::beginTransaction();
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        DB::commit();

        return response()->json(['message' => 'Berhasil Hapus Data Kelas'], 200);
    }

    // mapel
    public function mapel()
    {
        $k = Kejuruan::orderBy('nama_kejuruan', 'asc')->get();
        return view('mapel', compact('k'));
    }

    // data mapel
    public function data_mapel(Request $request)
    {
        if ($request->ajax()) {
            $data = Mapel::with('jurusan')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="badge rounded-pill text-bg-info ubah mb-2" data-id="' . $row->id . '">Ubah</button>
                <button class="badge rounded-pill text-bg-danger hapus mb-2" data-id="' . $row->id . '">Hapus</button>';
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
        $mapel->jurusan_id = $request->jurusan;
        $mapel->kkm = $request->kkm;
        $mapel->save();

        $g_mapel = new GuruMapel();
        $g_mapel->mapel_id = $mapel->id;
        $g_mapel->guru_id = NULL;
        $g_mapel->save();

        return response()->json(['message' => 'Berhasil Tambah Data Mapel'], 200);
    }

    // ambil data mapel per id
    public function get_data_mapel($id)
    {
        $mapel = Mapel::findOrFail($id);
        $k = Kejuruan::orderBy('nama_kejuruan', 'asc')->get();

        return view("modals.update_mapel", compact("mapel", "k"));
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
        $mapel->jurusan_id = $request->jurusan;
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

    // import
    public function import_mapel(Request $request)
    {
        $rules = [
            'file' => 'required|file|mimes:xlsx',
        ];

        $messages = [
            'file.required' => 'File harus diunggah',
            'file.file' => 'File yang diunggah harus berupa file',
            'file.mimes' => 'File yang diunggah harus berformat xlsx'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $path = $file->getRealPath();

        // spreadsheet
        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        array_shift($rows);
        DB::beginTransaction();

        $count = 0;

        foreach($rows as $r)
        {
            $jurusan = Kejuruan::where('nama_kejuruan', 'like', '%' . $r[4] . '%')->first();

            $mapel = new Mapel();
            $mapel->id = Uuid::uuid4()->toString();
            $mapel->kelompok = $r[0];
            $mapel->kode = $r[1];
            $mapel->nama_mapel = $r[2];
            $mapel->tingkat = $r[3];
            $mapel->jurusan_id = $jurusan->id;
            $mapel->kkm = $r[5];
            $mapel->save();

            $g_mapel = new GuruMapel();
            $g_mapel->mapel_id = $mapel->id;
            $g_mapel->guru_id = NULL;
            $g_mapel->save();

            $count++;
        }

        DB::commit();

        return response()->json(['message' => 'Berhasil Import '. $count . 'Data Mapel'], 200);
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

    public function update_profile_sekolah(Request $request)
    {
        DB::beginTransaction();

        // Get the current active TahunAjaran
        $th_aj = TahunAjaran::where('status', 'Y')->first();

        if (!$th_aj) {
            return response()->json(['error' => 'Active TahunAjaran tidak ditemukan'], 404);
        }

        $th_now = $th_aj->tahun;
        $now = $request->tahun_ajaran;

        // Get the first ProfilSekolah
        $ps = ProfilSekolah::first();

        if (!$ps) {
            return response()->json(['error' => 'ProfilSekolah tidak ditemukan'], 404);
        }

        // Validasi input dengan pesan kustom
        $request->validate([
            'npsn' => 'required',
            'nama_sekolah' => 'required',
            'alamat' => 'required',
            'kode_pos' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kab_kot' => 'required',
            'provinsi' => 'required',
            'kep_id' => 'required',
            'tahun_ajaran' => 'required',
            'logo_sekolah' => 'nullable|image|mimes:jpg,jpeg,png', // validasi file gambar
        ], [
            'npsn.required' => 'NPSN harus diisi.',
            'nama_sekolah.required' => 'Nama sekolah harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'kode_pos.required' => 'Kode pos harus diisi.',
            'kelurahan.required' => 'Kelurahan harus diisi.',
            'kecamatan.required' => 'Kecamatan harus diisi.',
            'kab_kot.required' => 'Kabupaten/Kota harus diisi.',
            'provinsi.required' => 'Provinsi harus diisi.',
            'kep_id.required' => 'ID Kepala Sekolah harus diisi.',
            'tahun_ajaran.required' => 'Tahun ajaran harus diisi.',
            'logo_sekolah.image' => 'File gambar harus berupa gambar.',
            'logo_sekolah.mimes' => 'Gambar harus memiliki ekstensi jpg, jpeg, atau png.',
        ]);

        if ($th_now == $now) {
            // Update ProfilSekolah
            $ps->npsn = $request->npsn;
            $ps->nama_sekolah = $request->nama_sekolah;
            $ps->alamat = $request->alamat;
            $ps->kode_pos = $request->kode_pos;
            $ps->kelurahan = $request->kelurahan;
            $ps->kecamatan = $request->kecamatan;
            $ps->kab_kot = $request->kab_kot;
            $ps->provinsi = $request->provinsi;
            $ps->kep_id = $request->kep_id;
            $ps->th_aktif = $request->tahun_ajaran;

            if ($request->hasFile('logo_sekolah')) {
                // Handle the image upload
                $file = $request->file('logo_sekolah');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = 'logo/' . $fileName;
                $file->move(public_path('logo'), $fileName);
                $ps->logo = $filePath;
            }

            $ps->save();
        } else {
            // Deactivate the current active TahunAjaran
            $th_aj->status = 'N';
            $th_aj->save();

            // Activate the new TahunAjaran
            $th_new = TahunAjaran::where('tahun', $now)->first();

            if (!$th_new) {
                return response()->json(['error' => 'TahunAjaran untuk tahun yang diberikan tidak ditemukan'], 404);
            }

            $th_new->status = 'Y';
            $th_new->save();

            // Update ProfilSekolah
            $ps->npsn = $request->npsn;
            $ps->nama_sekolah = $request->nama_sekolah;
            $ps->alamat = $request->alamat;
            $ps->kode_pos = $request->kode_pos;
            $ps->kelurahan = $request->kelurahan;
            $ps->kecamatan = $request->kecamatan;
            $ps->kab_kot = $request->kab_kot;
            $ps->provinsi = $request->provinsi;
            $ps->kep_id = $request->kep_id;
            $ps->th_aktif = $request->tahun_ajaran;

            if ($request->hasFile('logo_sekolah')) {
                // Handle the image upload
                $file = $request->file('logo_sekolah');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = 'logo/' . $fileName;
                $file->move(public_path('logo'), $fileName);
                $ps->logo = $filePath;
            }

            $ps->save();
        }

        DB::commit();

        return response()->json(['message' => 'Berhasil Ubah Profile Sekolah'], 200);
    }


    public function profil_smk()
    {
        $th = TahunAjaran::all();
        $ks = User::with(['personalData', 'guru'])->where('role_id', 2)->get();
        $p = ProfilSekolah::first();
        return view('profile_smk', compact('th', 'p', 'ks'));
    }

    // halaman atur wali kelas
    public function set_wakel()
    {
        $guru = User::with(['personalData', 'guru'])->where('role_id', 2)->get();
        return view('set_wakel', compact('guru'));
    }

    // memilih wali kelas di setiap kelas yang ada
    public function select_wakel(Request $request)
    {
        $class = $request->class_id;
        $guru = $request->guru_id;

        $cek = Guru::where('class_id', $class)->first();

        if(!$cek)
        {
            $guru = Guru::where('user_id', $guru)->first();

            $guru->wali_kelas = 'Y';
            $guru->class_id = $class;
            $guru->save();
        }else{

            if($cek->user_id == $guru)
            {
                $guru = Guru::where('user_id', $guru)->first();
                $guru->wali_kelas = 'N';
                $guru->class_id = NULL;
                $guru->save();
            }else{
                $cek->wali_kelas = 'N';
                $cek->class_id = NULL;
                $cek->save();

                $guru = Guru::where('user_id', $guru)->first();
                $guru->wali_kelas = 'Y';
                $guru->class_id = $class;
                $guru->save();
            }
        }

        return response()->json(['message' => 'Berhasil Memilih Wali Kelas'], 200);
    }

    public function get_kelas_wakel(Request $request)
    {
        if($request->ajax())
        {
            $data = Kelas::leftJoin('guru as g', 'kelas.id', '=', 'g.class_id')
            ->leftJoin('users as u', 'g.user_id', '=', 'u.id')
            ->leftJoin('personal_data as pd', 'u.personal_id', '=', 'pd.id')
            ->select('kelas.id as kelas_id', 'kelas.nama_rombel', 'kelas.tingkat', 'pd.nama', 'kelas.status')
            ->orderBy('kelas.nama_rombel', 'asc')
            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    $btn = '<button class="badge rounded-pill text-bg-info pilih" data-id="' . $row->kelas_id . '">Pilih</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function set_mapel()
    {
        $g = User::with('personalData')->where('role_id', 2)->get();
        return view('set_mapel', compact('g'));
    }

    public function data_guru_mapel(Request $request)
    {
        if($request->ajax())
        {
            $data = GuruMapel::with('mapel.jurusan', 'guru.personalData')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    $btn = '<button class="badge rounded-pill text-bg-info pilih" data-id="' . $row->mapel_id . '">Pilih</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function select_guru_mapel(Request $request)
    {
        $gm = GuruMapel::find($request->mapel_id);
        $gm->guru_id = $request->guru_id;
        $gm->save();
        return response()->json(['message' => 'Berhasil Memilih Guru Mapel'], 200);
    }

    public function pesan()
    {
        return view('message');
    }

    public function send_message(Request $request)
    {
        $info = new Info();

        $info->id = Uuid::uuid4();
        $info->judul = $request->judul;
        $info->isi = $request->isi_pesan;
        $info->create_at = date('Y-m-d H:i:s');
        $info->user_id = Auth::user()->id;
        $info->save();

        return response()->json(['message' => 'success'], 200);
    }

    public function getMessages()
    {
        // Mengambil data dengan relasi
        $data = Info::select('id', 'judul', 'isi', 'create_at', 'user_id')
            ->with(['user.personalData:id,nama']) // Mengambil kolom tertentu dari personal_data
            ->get()
            ->map(function ($info) {
                return [
                    'id' => $info->id,
                    'judul' => $info->judul,
                    'isi' => $info->isi,
                    'created_at' => $info->created_at,
                    'personal_data_name' => $info->user->personalData->nama ?? null,
                ];
            });

        // Mengembalikan data dalam format JSON
        return response()->json($data);
    }
}
