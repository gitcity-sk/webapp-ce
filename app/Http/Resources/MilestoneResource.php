<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MilestoneResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'issues_count' => $this->issues->count(),
            'created_at' => $this->created_at
        ];
    }
}
