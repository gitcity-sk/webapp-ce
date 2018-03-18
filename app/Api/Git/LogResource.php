<?php

namespace App\Api\Git;

use GitElephant\Objects\Log;


class LogResource extends GitResource
{
    /**
     * @param $entity
     * @return array|null
     * @throws \Exception
     */
    public static function collection($entity)
    {
        if (null == $entity) return null;

        if (! $entity instanceof Log) throw new \Exception("Entity must be instance of " . Log::class);

        $array = [];
        $AnonymousResource = get_called_class();

        foreach ($entity as $item)
        {
            $array[] = (new $AnonymousResource($item))->toArray();
        }
        
        return $array;
    }
}