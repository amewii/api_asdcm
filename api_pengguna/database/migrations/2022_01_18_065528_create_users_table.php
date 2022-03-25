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
        Schema::create('table_users', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nama");
            $table->string("emel");
            $table->string("no_kad_pengenalan");
            $table->string("katalaluan");
            $table->string("notel");
            $table->string("tarikh_lahir");
            $table->bigInteger("FK_jenis_pengguna");
            $table->bigInteger("FK_gelaran");
            $table->bigInteger("FK_negara_lahir");
            $table->bigInteger("FK_negeri_lahir");
            $table->bigInteger("FK_jantina");
            $table->bigInteger("FK_warganegara");
            $table->bigInteger("FK_bangsa");
            $table->bigInteger("FK_etnik");
            $table->bigInteger("FK_agama");
            $table->bigInteger("status_rekod");
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
        Schema::dropIfExists('table_users');
    }
}
