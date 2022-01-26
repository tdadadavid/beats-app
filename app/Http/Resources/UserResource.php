<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'username' => $this->resource->name,
            'email' => $this->email,
            'email_verification_date' => $this->email_verified_at?->diffForHumans(),
            'profile_image' => $this->image,
            'isVerified' => $this->verified,
            'creation_date' => $this->created_at->diffForHumans(),
            'last_change' => $this->updated_at->diffForHumans(),
        ];
    }
}
