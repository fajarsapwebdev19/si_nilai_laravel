<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru'; // Nama tabel yang digunakan untuk model ini
    protected $primaryKey = null; // Nama kolom primary key
    public $incrementing = false; // Tetapkan false agar Laravel tidak menganggap primary key sebagai auto-increment
    protected $keyType = 'string'; // Tentukan tipe data untuk primary key
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = ['nik', 'nuptk', 'tempat_lahir', 'tanggal_lahir', 'jenis_ptk', 'wali_kelas', 'class_id', 'user_id']; // Kolom yang diizinkan untuk diisi massal
}
