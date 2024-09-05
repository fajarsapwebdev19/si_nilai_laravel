<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableAbsensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->string('id')->nullable(); // Primary key
            $table->string('tahun_ajaran')->nullable();
            $table->string('user_id')->nullable();
            $table->integer('sakit')->nullable();
            $table->integer('izin')->nullable();
            $table->integer('tanpa_keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
