<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('profiles', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name');
      $table->string('description');
      $table->string('address');
      $table->string('image')->default('https://via.placeholder.com/500x500?text=Sin+Foto');
      $table->bigInteger('price')->default(0);
      $table->unsignedInteger('type')->default(0);

      $table->unsignedBigInteger('commune_id');

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
    Schema::dropIfExists('profiles');
  }
}
