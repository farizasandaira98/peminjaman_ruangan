<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjam')->autoIncrement(false);
            $table->unsignedBigInteger('id_ruangan')->autoIncrement(false);
            $table->string('keperluan_peminjaman',50);
            $table->datetime('waktu_mulai_peminjaman');
            $table->datetime('waktu_akhir_peminjaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_peminjaman');
    }
};
