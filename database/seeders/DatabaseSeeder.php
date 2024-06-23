<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
        $uuids = Uuid::uuid4()->toString();
        $uuid3 = Uuid::uuid4()->toString();

        DB::table('users')->insert([
            [
                'id' => $uuids,
                'username' => 'administrator',
                'password' => Hash::make('administrator'),
                'real_password' => 'administrator',
                'status_account' => 'Y',
                'role_id' => 1,
                'personal_id' => 1,
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ]
        ]);
    }
}
