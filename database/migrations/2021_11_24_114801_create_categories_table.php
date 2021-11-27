<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->enum('name' , [
                ['Gospel' , 'Hip-Hop' , 'Country' , 'Jazz' , 'Rock' , 'sleep' , 'Others']
            ])->unique();
            $table->string('image_link')->nullable();
            $table->timestamps();
            $table->softDeletes();

            /* when it is fully functional
            then implement this feature
            $table->string('image') => image for each category
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
