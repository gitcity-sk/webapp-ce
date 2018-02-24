<?php

namespace App\Http\Resources\Git;

use App\Api\Git\GitResource;

class BranchesResource extends GitResource
{
    public function toArray()
    {
        return [
            'name' => $this->entity->getName(),
            'hash' => $this->entity->getSha(),
            'commit' => [
                'hash_short' => $this->entity->getLastCommit()->getSha(true),
                'message' => $this->entity->getLastCommit()->getMessage()->getShortMessage(),
                'created_at' => $this->entity->getLastCommit()->getDateTimeAuthor()
            ]
        ];
    }
}
