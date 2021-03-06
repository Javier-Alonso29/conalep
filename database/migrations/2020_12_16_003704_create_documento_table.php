<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipodocumento');
            $table->foreign('id_tipodocumento')->references('id')->on('tipodocumento');
            $table->unsignedBigInteger('id_proceso_personal');
            $table->foreign('id_proceso_personal')->references('id')->on('proceso_personal');
            $table->string('nombre')->unique();
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
        Schema::dropIfExists('documento');
    }
}
