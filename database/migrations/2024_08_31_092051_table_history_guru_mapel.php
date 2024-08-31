<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableHistoryGuruMapel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_guru_mapel', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('tahun_ajaran')->nullable();
            $table->string('mapel_id')->nullable();
            $table->string('class_id')->nullable();
            $table->string('guru_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_guru_mapel');
    }
}
