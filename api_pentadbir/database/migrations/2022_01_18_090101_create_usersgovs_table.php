<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersgovsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersgovs', function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("FK_users");
            $table->string("FK_kategori_pengguna");
            $table->string("kod_jawatan");
            $table->string("nama_jawatan");
            $table->string("unit_organisasi");
            $table->string("gred");
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
        Schema::dropIfExists('usersgovs');
    }
}
