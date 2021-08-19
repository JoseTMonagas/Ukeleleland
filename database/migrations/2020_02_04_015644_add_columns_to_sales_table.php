<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('sesion');
            $table->unsignedBigInteger('total');
            $table->unsignedBigInteger('descuento')->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('estado')->default('EN PROCESO');
            $table->string('tipo_pago');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('sesion');
            $table->dropColumn('total');
            $table->dropColumn('descuento');
            $table->dropColumn('user_id');
            $table->dropColumn('estado');
            $table->dropColumn('tipo_pago');
        });
    }
}
