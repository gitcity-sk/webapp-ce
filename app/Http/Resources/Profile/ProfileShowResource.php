<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Url;

class ProfileShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => Url::signedRoute('storage.file', ['filename' => $this->image]),
            'description' => $this->description,
            'twitter' => $this->twitter,
            'facebook' => $this->facebook,
            'verified' => $this->verified,
            'user' => new UserResource($this->user)
        ];
    }
}
