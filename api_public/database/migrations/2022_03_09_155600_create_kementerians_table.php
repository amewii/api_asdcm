<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKementeriansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kementerians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_kementerian');
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('statusrekod');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kementerians');
    }
}
