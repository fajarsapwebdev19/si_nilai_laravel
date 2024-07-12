<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kejuruan extends Model
{
    use HasFactory;

    protected $table = 'kejuruan'; // Nama tabel yang digunakan untuk model ini
    protected $primaryKey = 'id'; // Nama kolom primary key
    protected $keyType = 'string'; // Tentukan tipe data untuk primary key
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = ['nama_kejuruan']; // Kolom yang diizinkan untuk diisi massal
}
