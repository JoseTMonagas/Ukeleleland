<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('format');
            $table->unsignedInteger('page_count');
            $table->string('title');
            $table->string('title_sort');
            $table->unsignedInteger('song_number');
            $table->boolean('public_domain');
            $table->unsignedInteger('performance_time')->default(0);
            $table->unsignedDecimal('difficulty_level_low', 3, 2)->default(0,0);
            $table->unsignedDecimal('difficulty_level_high', 3, 2 )->default(0,0);
            $table->unsignedSmallInteger('min_qty')->default(1);
            $table->string('file_name');
            $table->string('file_source');
            $table->string('file_type');
            $table->string('mime_type');
            $table->string('file_url');
            $table->boolean('world_rights');
            $table->unsignedDecimal('price', 5, 2);
            $table->string('type');
            $table->string('description', 4000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
