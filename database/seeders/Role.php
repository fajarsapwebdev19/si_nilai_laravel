<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'create_at' => date("Y-m-d H:i:s"),
                'modified_at' => NULL
            ],
            [
                'id' => 2,
                'name' => 'teacher',
                'create_at' => date("Y-m-d H:i:s"),
                'modified_at' => NULL
            ]
        ]);
    }
}
