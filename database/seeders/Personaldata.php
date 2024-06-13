<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Personaldata extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personal_data')->insert([
            [
                'id' => 1,
                'nama' => 'Administrator',
                'jenis_kelamin' => 'L',
                'alamat' => 'Lorem Ipsum No 1',
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ],
            [
                'id' => 2,
                'nama' => 'Teacher',
                'jenis_kelamin' => 'L',
                'alamat' => 'Lorem Ipsum No 123',
                'create_at' => date('Y-m-d H:i:s'),
                'modified_at' => NULL
            ],
        ]);
    }
}
