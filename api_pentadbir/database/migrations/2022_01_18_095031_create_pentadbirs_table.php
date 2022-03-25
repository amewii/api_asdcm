<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePentadbirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pentadbirs', function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("FK_users");
            $table->bigInteger("FK_capaian");
            $table->bigInteger("FK_kampus");
            $table->bigInteger("FK_kluster");
            $table->bigInteger("FK_unit");
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
        Schema::dropIfExists('pentadbirs');
    }
}
