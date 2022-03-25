<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoripenggunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategoripenggunas', function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("FK_jenis_pengguna");
            $table->string("kategori_pengguna");
            $table->string("kod_kategori_pengguna");
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
        Schema::dropIfExists('kategoripenggunas');
    }
}
