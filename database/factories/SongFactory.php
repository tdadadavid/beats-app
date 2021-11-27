<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Mp3;
use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'duration' => $this->faker->numberBetween(1, 15),
            'category_id' => $this->faker->numberBetween(1 , 7),
            'artist_id' => Artist::all()->random()->id,
            'date_of_release' => $this->faker->dateTime,

        ];
    }
}
