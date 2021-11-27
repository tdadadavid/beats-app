<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'song_id',
        'comment',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
