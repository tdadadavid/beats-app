<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->name,
            'song_image' => $this->image,
            'producer' => $this->artist_id,
            'producer_category' => $this->category_id,
            'release_date' => $this->date_of_release->diffForHumans(),
            'length' => $this->duration . ' min',
            'likes' => $this->no_of_likes,
            'dislikes' => $this->no_of_dislikes,
        ];
    }
}
