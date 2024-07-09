<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableProfileSekolah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_sekolah', function(Blueprint $table){
            $table->char('npsn', 8)->primary();
            $table->string('nama_sekolah')->nullable();
            $table->string('alamat')->nullable();
            $table->char('kode_pos', 8)->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kab_kot')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kep_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('th_aktif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_sekolah');
    }
}
