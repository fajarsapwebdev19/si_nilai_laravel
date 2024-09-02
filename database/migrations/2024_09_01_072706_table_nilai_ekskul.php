<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableNilaiEkskul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekskul', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('tahun_ajaran')->nullable();
            $table->string('user_id')->nullable();
            $table->string('ekskul_id')->nullable();
            $table->string('nilai')->nullable();
            $table->string('deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ekskul');
    }
}
