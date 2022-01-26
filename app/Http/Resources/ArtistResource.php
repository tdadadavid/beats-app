<?php

namespace App\Http\Resources;

use App\Models\Artist;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ArtistResource extends JsonResource
{
    public Artist $artist;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    public function toArray($request)
    {
        return [
            "artist_name" => $this->name,
            'category' => $this->id,
            'artist_image' => $this->image,
            'rank' => $this->rating,
            'creation_date' => $this->created_at->difForHumans(),
            'lastChanged' => $this->updated_at->diffForHumans(),
            'deletion_date' => $this->deleted_at->diffForHumans(),

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('artists.index')
                ],

                [
                    'rel' => 'followers',
                    'href' => route('artists.followers.index', $this->artist)
                ],

                [
                    'rel' => 'songs',
                    'href' => route('artists.songs.index' , $this->artist)
                ]
            ]


        ];
    }
}
