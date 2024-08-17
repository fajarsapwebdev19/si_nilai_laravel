<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableNilaiSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function(Blueprint $table){
            $table->string('user_id')->primary();
            $table->string('mapel_id');
            $table->string('tahun_ajaran');
            // Kolom nilai
            $table->decimal('nilai_pengetahuan', 5, 2);
            $table->decimal('nilai_keterampilan', 5, 2);
            $table->decimal('nilai_sikap', 5, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai');
    }
}
