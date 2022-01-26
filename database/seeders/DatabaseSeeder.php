<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Category;
use App\Models\Comments;
use App\Models\Reply;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
//
        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        DB::table('artists')->truncate();
        DB::table('comments')->truncate();
        DB::table('songs')->truncate();
        DB::table('replies')->truncate();
        DB::table('artist_user')->truncate();
        DB::table('song_user')->truncate();

        Category::factory(7)->create();
        User::factory(1000)->create();

        Artist::factory(500)->create()->each(
            function ($artist){
                $user = User::all()->random(mt_rand(1,1000))->pluck('id');
                $artist->users()->attach($user);
            }
        );

        Song::factory(700)->create()->each(
            function ($song){
                $user = User::all()->random(mt_rand(1,1000))->pluck('id');
                $song->users()->attach($user);
            }
        );

        Comments::factory(400)->create();
        Reply::factory(100)->create();

        // watch Juan meGon how he populated his pivot table





    }
}
