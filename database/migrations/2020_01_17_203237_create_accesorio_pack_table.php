<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesorioPackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesorio_pack', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('accesorio_id');
            $table->unsignedBigInteger('pack_id');
            $table->unsignedBigInteger('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesorio_pack');
    }
}
