<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserswastasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userswastas', function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("FK_users");
            $table->bigInteger("FK_kategori_pengguna");
            $table->string("jawatan");
            $table->string("alamat1_rumah");
            $table->string("alamat2_rumah");
            $table->string("poskod_rumah");
            $table->string("daerah_rumah");
            $table->string("negeri_rumah");
            $table->string("negara_rumah");
            $table->string("organisasi");
            $table->string("alamat1_organisasi");
            $table->string("alamat2_organisasi");
            $table->string("poskod_organisasi");
            $table->string("daerah_organisasi");
            $table->string("negeri_organisasi");
            $table->string("negara_organisasi");
            $table->string("nama_majikan");
            $table->string("notel_majikan");
            $table->string("emel_majikan");
            $table->string("status_rekod");
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
        Schema::dropIfExists('userswastas');
    }
}
