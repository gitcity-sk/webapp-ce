<?php

namespace App\Http\Resources\Git;

use App\Api\Git\GitResource;

class BranchesResource extends GitResource
{
    public function toArray()
    {
        return [
            'name' => $this->entity->getName(),
            'hash' => $this->entity->getSha()
        ];
    }
}
