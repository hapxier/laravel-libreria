<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Libro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo');
            $table->unsignedBigInteger('id_genero');
            $table->unsignedBigInteger('id_autor');
            $table->string('titulo', 50);
            $table->timestamps();

            $table->foreign('id_tipo')->references('id')->on('tipos');
            $table->foreign('id_genero')->references('id')->on('generos');
            $table->foreign('id_autor')->references('id')->on('autores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
