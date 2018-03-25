<?php

namespace App\Http\Resources\Label;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
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
            'text' => $this->title,
            'color' => $this->color,
            'description' => $this->description
        ];
    }
}
