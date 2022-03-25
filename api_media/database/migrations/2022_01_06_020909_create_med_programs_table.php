<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedprogramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('med_programs', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nama_program");
            $table->date("tarikh_program");
            $table->string("FK_kategori");
            $table->bigInteger("FK_kluster");
            $table->bigInteger("FK_kampus");
            $table->bigInteger("FK_unit");
            $table->longText("media_path");
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
        Schema::dropIfExists('med_programs');
    }
}
