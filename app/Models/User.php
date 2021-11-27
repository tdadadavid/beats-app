<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes , HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
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
