<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song', function (Blueprint $table) {
            Schema::create('songs', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('image')->nullable();
                $table->foreign('artist_id')->references('artists');
                $table->foreign('category_id' )->references('category');
                $table->string('duration');
                $table->enum('category' ,
                    ['Gospel' , 'Hip-Hop' , 'Country' , 'Jazz' , 'Rock' , 'sleep' , 'Others']
                );
                $table->integer('no_of_likes')->nullable();
                $table->integer('no_of_dislikes')->nullable();
                $table->integer('size')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song');
    }
}
