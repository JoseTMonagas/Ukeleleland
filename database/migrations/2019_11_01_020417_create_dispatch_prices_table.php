<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispatchPricesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('dispatch_prices', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedInteger('commune_id');
      $table->foreign('commune_id')->references('id')->on('communes');
      $table->integer('price')->default(0);
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
    Schema::dropIfExists('dispatch_prices');
  }
}
