<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('med_status', function (Blueprint $table) {
            $table->increments("id");
            $table->string("kod_status");
            $table->string("nama_status");
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
        Schema::dropIfExists('med_status');
    }
}
