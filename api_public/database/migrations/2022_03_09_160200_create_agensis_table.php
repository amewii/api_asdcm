<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agensis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_agensi');
            $table->string('FK_kementerian');
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
        Schema::dropIfExists('agensis');
    }
}
