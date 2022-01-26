<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'category_name' => $this->name,
            'image' => $this->image_link,
            'creation_date' => $this->created_at,
            'lastChanged' => $this->updated_at,
            'deletion_date' => $this->deleted_at
        ];
    }
}
