<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableInputKenaikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kenaikan', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('tahun_ajaran')->nullable();
            $table->string('user_id')->nullable();
            $table->string('status_kenaikan')->nullable();
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
        Schema::dropIfExists('kenaikan');
    }
}
