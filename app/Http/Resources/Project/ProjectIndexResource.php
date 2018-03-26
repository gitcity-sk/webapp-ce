<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Profile\ProfileResource;

class ProjectIndexResource extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'profile' => new ProfileResource($this->user->profile),
            'created_at' => $this->created_at,
            'issues_count' => $this->issues->count(),
            'mr_count' => $this->mergeRequests->count(),
            'groups_count' => $this->groups->count()
        ];
    }
}
