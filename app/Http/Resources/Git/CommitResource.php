<?php

namespace App\Http\Resources\Git;

use App\Api\Git\LogResource;

class CommitResource extends LogResource
{
    public function toArray()
    {
        return [
            'author' => [
                'name' => $this->entity->getAuthor()->getName(),
                'email' => $this->entity->getAuthor()->getEmail()
            ],
            'hash' => $this->entity->getSha(),
            'message' => $this->entity->getMessage()->__toString()
        ];
    }
}
