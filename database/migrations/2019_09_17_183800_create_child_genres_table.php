<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_genres', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_genre_id');
            $table->string('child_genre_name');
            $table->text('child_genre_detail');
            $table->string('child_genre_image');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });

        Schema::table('child_genres', function($table) {
       $table->foreign('parent_genre_id')->references('id')->on('parent_genres')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_genres');
    }
}
