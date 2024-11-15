<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('username', 300);
            $table->string('password', 300);
            $table->string('real_password', 300);
            $table->enum('status_account', ['Y', 'N'])->nullable();
            $table->integer('role_id');
            $table->string('personal_id');
            $table->datetime('create_at')->nullable();
            $table->datetime('modified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
