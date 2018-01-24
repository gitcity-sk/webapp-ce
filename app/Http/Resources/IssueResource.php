<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class IssueResource extends Resource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'comments' => CommentResource::collection($this->comments),
            'user' => $this->user,
            'project' => $this->project
          ];
    }
}
