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
use Faker\Provider\ar_EG\Person;
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
    public function sensorNik($nik, $mask_char = '*', $num_visible_start = 4, $num_visible_end = 4)
    {
        $start = substr($nik, 0, $num_visible_start);
        $end = substr($nik, -$num_visible_end);
        $masked_length = strlen($nik) - ($num_visible_start + $num_visible_end);
        $masked = str_repeat($mask_char, $masked_length);

        return $start . $masked . $end;
    }

    // data guru
    public function data_guru(Request $request)
    {
        if ($request->ajax()) {
            // Ambil data User dengan relasi 'personal' dan 'guru' yang memiliki role_id = 2
            $data = User::with(['personalData', 'guru'])
                ->where('role_id', 2)
                ->get();

            // Menggunakan DataTables untuk mengubah data menjadi format JSON yang sesuai
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nik', function ($row) {
                    // Mengakses properti 'nik' dari relasi 'guru' pada setiap row
                    return $this->sensorNik($row->guru->nik); // Perbaikan: Menggunakan $row->guru->nik
                })
                ->addColumn('action', function ($row) {
                    // Tombol aksi untuk setiap baris data
                    $btn = '<button class="badge rounded-pill text-bg-info ubah" data-id="' . $row->id . '">Ubah</button> ';
                    $btn .= '<button class="badge rounded-pill text-bg-danger hapus" data-id="' . $row->id . '">Hapus</button>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    // Kolom status dengan ikon berdasarkan nilai 'status'
                    return $row->status_account == "Y" ? '<em class="fas fa-check-circle text-success"></em>' : '<em class="fas fa-times-circle text-danger"></em>';
                })
                ->rawColumns(['action', 'nik', 'status']) // Menandakan kolom yang berisi HTML
                ->toJson(); // Mengonversi data menjadi format JSON
        }
    }

    // proses tambah data
    public function tambah_guru(Request $request)
    {
        $p_id = mt_rand(0, 99999);
        $personal = new PersonalData();
        $personal->id = $p_id;
        $personal->nama = $request->nama;
        $personal->jenis_kelamin = $request->jenis_kelamin;
        $personal->alamat = $request->alamat;
        $personal->save();

        $user = new User();
        $uid = Uuid::uuid4()->toString();
        $user->id = $uid;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->real_password = $request->password;
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
        $guru->wali_kelas = $request->sts_wls;
        $guru->class_id = $request->kelas_id;
        $guru->user_id = $uid;
        $guru->save();

        return response()->json(['message' => 'Berhasil Tambah Data Guru'], 200);
    }

    // ambil data guru untuk ditampilkan kedalam form edit
    public function get_teacher_edit($id)
    {
        $t = User::with('personalData', 'guru')->find($id);
        $k = Kelas::where('status', 'y')->get();

        return view('modals.editguru', compact('t', 'k'));
    }

    public function ubah_guru(Request $request, $id)
    {
        $u = User::with('personalData', 'guru')->find($id);
        $p = PersonalData::find($u->personal_id);
        $t = Guru::where('user_id', $u->id);
        $u->password = ($request->password);
        $u->real_password = $request->password;
        $u->modified_at = date('Y-m-d H:i:s');
        $p->nama = $request->nama;
        $p->jenis_kelamin = $request->jenis_kelamin;
        $p->alamat = $request->alamat;
        $t->nik = $request->nik;
        $t->nuptk = $request->nuptk;
        $t->tempat_lahir = $request->t_lahir;
        $t->tanggal_lahir = $request->tgl_lahir;
        $t->jenis_ptk = $request->jenis_ptk;
        $t->wali_kelas = $request->wali_kelas;

    }

    public function student()
    {
        return view('student');
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
                    $btn = '<button class="badge rounded-pill text-bg-primary student-get" data-id="' . $row->id . '">Siswa</button> <button class="badge rounded-pill text-bg-info ubah" data-id="' . $row->id . '">Ubah</button> <button class="badge rounded-pill text-bg-danger hapus" data-id="' . $row->id . '">Hapus</button>';
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
