<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

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
