<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'artists';


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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class , 'artist_user' );

    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }


}
