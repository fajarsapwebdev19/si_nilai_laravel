<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // Nama tabel yang digunakan untuk model ini
    protected $primaryKey = 'id'; // Nama kolom primary key
    public $incrementing = false; // Tetapkan false agar Laravel tidak menganggap primary key sebagai auto-increment
    protected $keyType = 'string'; // Tentukan tipe data untuk primary key
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = ['id', 'nama_rombel', 'tingkat', 'jurusan_id', 'status']; // Kolom yang diizinkan untuk diisi massal

    public function jurusan()
    {
        return $this->belongsTo(Kejuruan::class, 'jurusan_id');
    }
}
