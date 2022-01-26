<?php

namespace Database\Factories;

use App\Models\Comments;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&@#)(*}{]["><:-');
        $password = substr($random, 0, 12);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make($password), // password
            'remember_token' => Str::random(12),
            'verified' => $verified =  $this->faker->randomElement([User::VERIFIED , USER::UNVERIFIED]),
            'verification_token' => ($verified == User::VERIFIED)
                ? null
                : Str::random(6) . $password
            ,
            'email_verified_at' => ($verified == User::VERIFIED)
                ? now()
                : null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

}
