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

        User::truncate();
        Category::truncate();
        Artist::truncate();
        Comments::truncate();
        Song::truncate();
        Reply::truncate();



         User::factory(600)->create();
        Category::factory(7)->create();
        Artist::factory(80)->create();
        Song::factory(300)->create();
        Comments::factory(100)->create();
         Reply::factory(30)->create();

    }
}
