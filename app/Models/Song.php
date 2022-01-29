<?php

namespace App\Models;

use DirectoryIterator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\JsonResponse;

class Song extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name', 'artist_id', 'duration',
        'category_id', 'date_of_release','image',
        'size', 'no_of_likes', 'no_of_dislikes',
        'file_size'
    ];

    protected $casts = [
        'date_of_release' => 'datetime'
    ];

    protected $hidden = [
        'pivot'
    ];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }




}


