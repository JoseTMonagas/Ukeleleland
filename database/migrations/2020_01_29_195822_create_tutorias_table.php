<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');
            $table->unsignedInteger('cantidad');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->boolean('completado')->default(false);
            $table->string('observaciones')->nullable();
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
        Schema::dropIfExists('tutorias');
    }
}
