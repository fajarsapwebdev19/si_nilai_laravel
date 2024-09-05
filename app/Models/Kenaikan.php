<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kenaikan extends Model
{
    use HasFactory;

    protected $table = 'kenaikan'; // Nama tabel yang digunakan untuk model ini
    protected $primaryKey = 'id'; // Nama kolom primary key
    public $incrementing = false; // Tetapkan false agar Laravel tidak menganggap primary key sebagai auto-increment
    protected $keyType = 'string'; // Tentukan tipe data untuk primary key
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = ['id', 'tahun_ajaran', 'user_id', 'status_kenaikan', 'deskripsi']; // Kolom yang diizinkan untuk diisi massal
}
