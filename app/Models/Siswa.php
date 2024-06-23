<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa'; // Nama tabel yang digunakan untuk model ini
    protected $primaryKey = 'user_id'; // Nama kolom primary key
    public $incrementing = false; // Tetapkan false agar Laravel tidak menganggap primary key sebagai auto-increment
    protected $keyType = 'string'; // Tentukan tipe data untuk primary key
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = ['nisn','nik', 'tempat_lahir', 'tanggal_lahir', 'agama', 'rt', 'rw', 'kelurahan', 'kecamatan', 'kode_pos', 'anak_ke', 'nama_ayah', 'pendidikan_ayah','pekerjaan_ayah', 'nama_ibu', 'pendidikan_ibu', 'pekerjaan_ibu']; // Kolom yang diizinkan untuk diisi massal
}
