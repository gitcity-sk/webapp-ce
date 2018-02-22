<?php

namespace App\Http\Resources\Git;

use App\Api\Git\GitResource;

class TagsResource extends GitResource
{
    public function toArray()
    {
        return [
            'name' => $this->entity->getName(),
            'hash' => $this->entity->getSha(),
            'hash_short' => $this->entity->getSha(true),
        ];
    }
}
