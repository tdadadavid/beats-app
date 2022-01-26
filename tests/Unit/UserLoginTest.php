<?php

namespace Tests\Unit;

use App\Models\User;
use App\Notifications\WelcomeNotificationEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserLoginTest extends TestCase
{

//    use RefreshDatabase;
//
//    public function test_new_user_is_stored_and_notification_is_sent()
//    {
//
//
//        $newUser = User::factory()->create([
//            'name' => "king Jaja",
//            "email" => "kingJaja@gmail.com",
//            "password" => Hash::make(Str::random()),
//            "verified" => 0 ,
//            "verification_token" => Str::random(40)
//        ]);
//
//        // work on notification and check the database* (refreshdatabse)
//
//        Notification::fake();
//
//        $this->assertDatabaseHas('users', [
//            'email' => $newUser->email
//        ]);
//
//        Notification::assertSentTo($newUser , WelcomeNotificationEmail::class , function ($notification) use($newUser) {
//            return $notification->user->id == $newUser->id;
//        });
//
//    }
//
//    public function test_login_route_is_working()
//    {
//        $response = $this->get('/login');
//
//        $response->assertDontSee("Welcome back!");
//    }
}
