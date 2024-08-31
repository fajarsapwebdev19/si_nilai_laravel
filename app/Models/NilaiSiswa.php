<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;

    protected $table = 'nilai'; // Nama tabel yang digunakan untuk model ini
    protected $primaryKey = 'user_id'; // Nama kolom primary key
    public $incrementing = false; // Tetapkan false agar Laravel tidak menganggap primary key sebagai auto-increment
    protected $keyType = 'string'; // Tentukan tipe data untuk primary key
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = ['user_id', 'mapel_id', 'tahun_ajaran', 'nilai_pengetahuan', 'nilai_keterampilan']; // Kolom yang diizinkan untuk diisi massal
}
