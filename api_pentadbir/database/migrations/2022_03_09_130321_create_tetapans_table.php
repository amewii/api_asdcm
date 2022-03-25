<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTetapansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tetapans', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nama_sistem");
            $table->string("versi_sistem");
            $table->string("pelepasan_sistem");
            $table->string("status_sistem");
            $table->string("min_katalaluan");
            $table->string("polisi_katalaluan");
            $table->string("active_until");
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
        Schema::dropIfExists('tetapans');
    }
}
