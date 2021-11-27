<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'category_name',
        'image'
    ];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
