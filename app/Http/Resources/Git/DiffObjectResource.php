<?php

namespace App\Http\Resources\Git;

use App\Api\Git\DiffResource;

class DiffObjectResource extends DiffResource
{
    public function toArray()
    {
        return [
            'mode' => $this->entity->getMode(),
            'original_path' => $this->entity->getOriginalPath(),
            'destination_path' => $this->entity->getOriginalPath(),
            'changes_count' => $this->entity->count()
        ];
    }
}
