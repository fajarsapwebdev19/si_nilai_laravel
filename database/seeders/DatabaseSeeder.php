<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('profile_sekolah')->insert([
            [
                'npsn' => '69987103',
                'nama_sekolah' => 'SMK PGRI NEGLASARI',
                'alamat' => 'Jl Marsekal Surya Darma No 1 RT 03/ RW 04',
                'kode_pos' => '15127',
                'kelurahan' => 'Selapajang Jaya',
                'kecamatan' => 'Neglasari',
                'kab_kot' => 'Kota Tangerang',
                'provinsi' => 'Banten',
                'kep_id' => NULL,
                'logo' => NULL,
                'th_aktif' => '2023/2024 1'
            ]
        ]);

        // tingkat
        DB::table('tingkat')->insert([
            [
                'id' => 1,
                'tingkat' => 10
            ],
            [
                'id' => 2,
                'tingkat' => 11
            ],
            [
                'id' => 3,
                'tingkat' => 12
            ]
        ]);

        // tahun_ajaran
        DB::table('tahun_ajaran')->insert([
            [
                'tahun' => '2023/2024 1',
                'status' => 'Y'
            ],
            [
                'tahun' => '2023/2024 2',
                'status' => 'N'
            ],
            [
                'tahun' => '2024/2025 1',
                'status' => 'N'
            ],
            [
                'tahun' => '2024/2025 2',
                'status' => 'N'
            ]
        ]);

        // ekstrakulikuller
        DB::table('ekstrakulikuler')->insert([
            [
                'id' => 1,
                'nama_ekstrakulikuler' => 'Pramuka'
            ],
            [
                'id' => 2,
                'nama_ekstrakulikuler' => 'Paskibra'
            ],
            [
                'id' => 3,
                'nama_ekstrakulikuler' => 'Marawis'
            ],
            [
                'id' => 4,
                'nama_ekstrakulikuler' => 'Futsal'
            ],
            [
                'id' => 5,
                'nama_ekstrakulikuler' => 'OSIS'
            ],
        ]);

        // role
        DB::table('role')->insert(
        [
            [
                'id' => 1,
                'name' => 'Admin',
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ],
            [
                'id' => 2,
                'name' => 'Guru',
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ],
            [
                'id' => 3,
                'name' => 'Siswa',
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ]
        ]);

        // personal_data
        DB::table('personal_data')->insert(
        [
            [
                'id' => 1,
                'nama' => 'Administrator',
                'jenis_kelamin' => 'L',
                'alamat' => 'Lorem 100',
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ],
            [
                'id' => 2,
                'nama' => 'Guru',
                'jenis_kelamin' => 'L',
                'alamat' => 'Lorem 100 xca',
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ],
            [
                'id' => 3,
                'nama' => 'Siswa',
                'jenis_kelamin' => 'L',
                'alamat' => 'Ipsum Dolor Amet',
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ]
       ]);

       $u1 = Uuid::uuid4()->toString();
       $u2 = Uuid::uuid4()->toString();
       $u3 = Uuid::uuid4()->toString();

       $nisn = mt_rand(0011111111, 9999999999);

        // user
        DB::table('users')->insert([
            [
                'id' => $u1,
                'username' => 'administrator',
                'password' => Hash::make('administrator'),
                'real_password' => 'administrator',
                'status_account' => 'Y',
                'role_id' => 1,
                'personal_id' => 1,
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ],
            [
                'id' => $u2,
                'username' => 'guru',
                'password' => Hash::make('guru'),
                'real_password' => 'guru',
                'status_account' => 'Y',
                'role_id' => 2,
                'personal_id' => 2,
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ],
            [
                'id' => $u3,
                'username' => $nisn,
                'password' => Hash::make('siswa'),
                'real_password' => 'siswa',
                'status_account' => 'Y',
                'role_id' => 3,
                'personal_id' => 3,
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ]
        ]);

        // guru
        DB::table('guru')->insert([
            [
                'nik' => mt_rand(1111111111111111, 9999999999999999),
                'nuptk' => mt_rand(1111111111111111, 9999999999999999),
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2000-01-12',
                'jenis_ptk' => 'Guru Mata Pelajaran',
                'wali_kelas' => 'N',
                'class_id' => NULL,
                'user_id' => $u2
            ]
        ]);

        // kelas siswa
        DB::table('kelas_siswa')->insert([
            [
                'user_id' => $u3,
                'class_id' => NULL
            ]
        ]);

        // siswa
        DB::table('siswa')->insert([
            [
                'nisn' => $nisn,
                'nik' => mt_rand(1111111111111111, 9999999999999999),
                'tempat_lahir' => 'Tangerang',
                'tanggal_lahir' => '2007-10-11',
                'agama' => 'Islam',
                'rt' => '01',
                'rw' => '03',
                'kelurahan' => 'Selapajang Jaya',
                'kecamatan' => 'Neglasari',
                'kode_pos' => '15127',
                'anak_ke' => '2',
                'nama_ayah' => 'Sutisna',
                'pendidikan_ayah' => 'SD Sederajat',
                'pekerjaan_ayah' => 'Buruh',
                'nama_ibu' => 'Sutini',
                'pendidikan_ibu' => 'SD Sederajat',
                'pekerjaan_ibu' => 'Tidak Bekerja',
                'tingkat' => 10,
                'status' => 'y',
                'user_id' => $u3
            ]
        ]);
    }
}
