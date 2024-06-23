<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tingkat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
