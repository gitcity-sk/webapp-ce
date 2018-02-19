<?php

namespace App\Http\Resources\Git;

use App\Api\Git\GitResource;

class TreeResource extends GitResource
{
    public function toArray()
    {
        return [
            'name' => $this->request->getName(),
            'type' => $this->request->getType(),
            'last_commit' => [
                'author' => $this->request->getLastCommit()->getAuthor()->getName(),
                'message' => $this->request->getLastCommit()->getMessage()->getShortMessage()
            ]
        ];
    }
}
