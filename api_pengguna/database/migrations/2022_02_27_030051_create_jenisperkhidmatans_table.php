<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisperkhidmatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenisperkhidmatans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_jenisperkhidmatan');
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
        Schema::dropIfExists('jenisperkhidmatans');
    }
}
