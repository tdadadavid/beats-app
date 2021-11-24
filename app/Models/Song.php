<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'artist_id',
        'duration',
        'category_id',
        'date_of_release',
        'image',
        'size'
    ];

    protected $casts = [
        'date_of_release' => 'datetime'
    ];


    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function sizeOfSong()
    {

    }

}


