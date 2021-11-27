<?php

namespace Database\Factories;

use App\Models\Comments;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reply' => $this->faker->paragraph(1 , 20),
            'song_id' => Song::all()->random()->id,
            'comment_id' => Comments::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
