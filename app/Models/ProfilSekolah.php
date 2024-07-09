<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasFactory;

    protected $table = 'profile_sekolah'; // Nama tabel yang digunakan untuk model ini
    protected $primaryKey = 'id'; // Nama kolom primary key
    public $incrementing = false; // Tetapkan false agar Laravel tidak menganggap primary key sebagai auto-increment
    protected $keyType = 'string'; // Tentukan tipe data untuk primary key
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = ['npsn', 'nama_sekolah', 'alamat', 'kode_pos', 'kelurahan', 'kecamatan', 'kab_kot', 'provinsi', 'kep_id', 'logo', 'th_aktif']; // Kolom yang diizinkan untuk diisi massal
}
