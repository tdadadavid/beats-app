<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('artist_id');
            $table->string('duration');
            $table->enum('category' ,
                ['Gospel' , 'Hip-Hop' , 'Country' , 'Jazz' , 'Rock' , 'sleep' , 'Others']
            );
            $table->integer('no_of_likes')->nullable();
            $table->integer('no_of_dislikes')->nullable();
            $table->integer()
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
        Schema::dropIfExists('songs');
    }
}
