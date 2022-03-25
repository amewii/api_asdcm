<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIlawamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ilawams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_ila');
            $table->string('kod_ila');
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
        Schema::dropIfExists('ilawams');
    }
}
