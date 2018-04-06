<?php

namespace App\Api\Git;

use GitElephant\Objects\GitObject;

class GitResource
{
    /**
     * GitResource constructor.
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity  = $entity;
    }

    /**
     * @param $entity
     * @return array|null
     * @throws \Exception
     */
    public static function collection($entity)
    {
        if (null == $entity) {
            return null;
        }

        if (! $entity instanceof GitObject) {
            throw new \Exception("Entity must be instance of " . GitObject::class);
        }

        $array = [];
        $AnonymousResource = get_called_class();

        foreach ($entity as $item) {
            $array[] = (new $AnonymousResource($item))->toArray();
        }

        return $array;
    }
}
