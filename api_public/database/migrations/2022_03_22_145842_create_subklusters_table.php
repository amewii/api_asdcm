<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubklustersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subklusters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_subkluster');
            $table->bigInteger('FK_kluster');
            $table->timestamps();
            $table->string('statusrekod');
            $table->string('created_by');
            $table->string('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subklusters');
    }
}
