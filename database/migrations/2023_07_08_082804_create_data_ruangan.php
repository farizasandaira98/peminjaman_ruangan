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
        Schema::create('data_ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruangan',50);
            $table->integer('kapasitas',4)->autoIncrement(false);
            $table->integer('status_ruangan',1)->autoIncrement(false);
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
        Schema::dropIfExists('data_ruangan');
    }
};
