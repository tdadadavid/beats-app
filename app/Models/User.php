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

    const VERIFIED = 1;
    const UNVERIFIED = 0;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'verified',
        'verification_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'pivot',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'verified' => 'bool'
    ];


    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function isVerified(): bool
    {
        return $this->verified ===  self::VERIFIED;
    }

}
