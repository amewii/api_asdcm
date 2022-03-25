<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubmodulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_submoduls', function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("FK_users");
            $table->bigInteger("FK_useradmin");
            $table->bigInteger("FK_submodul");
            $table->bigInteger("FK_kampus");
            $table->bigInteger("FK_capaian");
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
        Schema::dropIfExists('user_submoduls');
    }
}
