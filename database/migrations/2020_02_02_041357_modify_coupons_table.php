<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('value');
            $table->dropColumn('percent_off');
            $table->dropColumn('minimum_quantity');
            $table->unsignedBigInteger('discount_id');
            $table->date('inicio');
            $table->date('fin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('discount_id');
            $table->dropColumn('inicio');
            $table->dropColumn('fin');
        });
    }
}
