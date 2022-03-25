<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaklumatkecemasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maklumatkecemasans', function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("FK_users");
            $table->string("nama");
            $table->string("notel");
            $table->string("status_rekod");
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
        Schema::dropIfExists('maklumatkecemasans');
    }
}
