<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableMapel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('kelompok')->nullable();
            $table->string('kode')->nullable();
            $table->string('nama_mapel')->nullable();
            $table->integer('tingkat')->nullable();
            $table->integer('kkm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapel');
    }
}
