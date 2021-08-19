<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySellablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellables', function (Blueprint $table) {
            $table->unsignedBigInteger('cantidad')->default(1);
            $table->unsignedBigInteger('precio');
            $table->string('url')->nullable();
            $table->string('transaction_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sellables', function (Blueprint $table) {
            $table->dropColumn('cantidad');
            $table->dropColumn('precio');
            $table->dropColumn('url');
            $table->dropColumn('transaction_id');
        });
    }
}
