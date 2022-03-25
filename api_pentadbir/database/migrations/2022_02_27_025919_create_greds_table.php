<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('greds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_gred');
            $table->timestamps();
            $table->string("created_by");
            $table->string("updated_by");
            $table->bigInteger("statusrekod");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('greds');
    }
}
