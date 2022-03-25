<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedkategoriprogramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('med_kategoriprograms', function (Blueprint $table) {
            $table->increments("id");
            $table->string("kod_kategori");
            $table->string("nama_kategori");
            $table->bigInteger("bilangan_fail");
            $table->string("kod_format");
            $table->bigInteger("saiz_fail");
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
        Schema::dropIfExists('med_kategoriprograms');
    }
}
