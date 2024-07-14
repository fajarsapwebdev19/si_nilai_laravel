<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruMapel extends Model
{
    use HasFactory;

    protected $table = 'guru_mapel'; // Nama tabel yang digunakan untuk model ini
    protected $primaryKey = 'mapel_id'; // Nama kolom primary key
    public $incrementing = false; // Tetapkan false agar Laravel tidak menganggap primary key sebagai auto-increment
    protected $keyType = 'string'; // Tentukan tipe data untuk primary key
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = ['mapel_id', 'guru_id']; // Kolom yang diizinkan untuk diisi massal

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
