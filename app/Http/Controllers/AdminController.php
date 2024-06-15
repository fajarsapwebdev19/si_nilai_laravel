<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Yajra\DataTables\DataTables;
use Ramsey\Uuid\Uuid;

class AdminController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function account()
    {
        return view('account');
    }

    public function teacher()
    {
        return view('teacher');
    }

    public function student()
    {
        return view('student');
    }

    // class

    // data kelas
    public function data_kelas(Request $request)
    {
        if ($request->ajax()) {
            $data = Kelas::all();

            return DataTables::of($data)
            ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="badge rounded-pill text-bg-primary student-get" data-id="'.$row->id.'">Siswa</button> <button class="badge rounded-pill text-bg-info ubah" data-id="'.$row->id.'">Ubah</button> <button class="badge rounded-pill text-bg-danger hapus" data-id="'.$row->id.'">Hapus</button>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status == 'y' ? "<em class='fas fa-check-circle text-success'></em>" : "<em class='fas fa-times-circle text-danger'></em>";
                    return $status;
                })
                ->rawColumns(['action','status'])
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
        $kelas->id = Uuid::uuid7()->toString();
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

    public function class_room()
    {
        return view('class');
    }

    public function mapel()
    {
        return view('mapel');
    }

    public function ekskul()
    {
        return view('ekskul');
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
