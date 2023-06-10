<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id('id_jabatan');
            $table->string('jabatan');
            $table->bigInteger('gaji')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('id_jabatan');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans')->onUpdate('cascade');
        });

        DB::table('jabatans')->insert([
            ['id_jabatan' => 1, 'jabatan' => 'none']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jabatans');
    }
};
