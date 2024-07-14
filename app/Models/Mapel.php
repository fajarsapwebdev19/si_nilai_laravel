<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel'; // Nama tabel yang digunakan untuk model ini
    protected $primaryKey = 'id'; // Nama kolom primary key
    public $incrementing = false; // Tetapkan false agar Laravel tidak menganggap primary key sebagai auto-increment
    protected $keyType = 'string'; // Tentukan tipe data untuk primary key
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = ['id', 'kelompok', 'kode', 'nama_mapel', 'tingkat', 'jurusan_id', 'kkm']; // Kolom yang diizinkan untuk diisi massal

    public function jurusan()
    {
        return $this->belongsTo(Kejuruan::class, 'jurusan_id');
    }

    public function guruMapel()
    {
        return $this->hasMany(GuruMapel::class, 'mapel_id');
    }
}
