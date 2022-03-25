<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedpermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('med_permohonans', function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("FK_user");
            $table->bigInteger("FK_program");
            $table->string("status_permohonan");
            $table->date("tarikh_permohonan");
            $table->date("tarikh_pengesahan");
            $table->date("tarikh_luput");
            $table->string("pegawai_pelulus");
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
        Schema::dropIfExists('med_permohonans');
    }
}
