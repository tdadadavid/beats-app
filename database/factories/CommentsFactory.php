<?php

namespace Database\Factories;

use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'song_id' => Song::all()->random()->id,
            'comments' => $this->faker->paragraph(2 ,100),
            'user_id' => User::all()->random()->id,
        ];
    }
}
