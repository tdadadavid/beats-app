<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'followers',
        'rating',
        'image'
    ];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }

    public function followers(): HasMany
    {
        return $this->hasMany(User::class);

    }

    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
