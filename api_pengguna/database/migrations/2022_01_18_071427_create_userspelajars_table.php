<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserspelajarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userspelajars', function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("FK_users");
            $table->bigInteger("FK_kategori_pengguna");
            $table->string("alamat1_rumah");
            $table->string("alamat2_rumah");
            $table->string("poskod_rumah");
            $table->string("daerah_rumah");
            $table->string("negeri_rumah");
            $table->string("negara_rumah");
            $table->string("nama_sekolah");
            $table->string("alamat1_sekolah");
            $table->string("alamat2_sekolah");
            $table->string("poskod_sekolah");
            $table->string("bandar_sekolah");
            $table->string("negeri_sekolah");
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
        Schema::dropIfExists('userspelajars');
    }
}
