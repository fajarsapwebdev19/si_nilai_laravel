<?php

namespace App\Models;

use Faker\Provider\ar_EG\Person;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Nama tabel yang digunakan untuk model ini
    protected $primaryKey = 'id'; // Nama kolom primary key
    public $incrementing = false; // Tetapkan false agar Laravel tidak menganggap primary key sebagai auto-increment
    protected $keyType = 'string'; // Tentukan tipe data untuk primary key
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = ['id', 'username', 'password', 'real_password','status_account', 'role_id', 'personal_id', 'create_at', 'modified_at']; // Kolom yang diizinkan untuk diisi massal

    public function personalData()
    {
        return $this->belongsTo(PersonalData::class, 'personal_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id');
    }
}
