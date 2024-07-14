<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('nama_rombel')->nullable();
            $table->integer('tingkat')->nullable();
            $table->string('jurusan_id')->nullable();
            $table->enum('status', ['y','n'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
