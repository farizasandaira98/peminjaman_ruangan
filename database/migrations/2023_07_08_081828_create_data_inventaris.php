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
        Schema::create('data_inventaris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ruangan',20)->autoIncrement(false);
            $table->string('nama_barang',50);
            $table->integer('jumlah_barang',4)->autoIncrement(false);
            $table->integer('kualitas_barang',1)->autoIncrement(false);
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
        Schema::dropIfExists('data_inventaris');
    }
};
