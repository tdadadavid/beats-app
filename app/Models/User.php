<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes , HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'pivot',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public static function randomStr()
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuiwxyz';
        $numbers = '0123456789';
        $randomString  = '';
        $randomNum = '';

        for ($i = 0; $i <= 10;  $i++){
            $randomString = $letters[rand(0 , strlen($letters))];
            $randomNum = $numbers[rand(0 , strlen($numbers))];
        }

        return $randomString . $randomNum;
    }
}
