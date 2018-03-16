<?php

namespace App;

use App\Repositories\Projects;
use App\Http\Resources\Git\TreeResource;
use App\Api\Git\BaseModel;

class Tree extends BaseModel
{
    public function get($userName, $projecSlug, $options = null)
    {
        if ($options !== null) $this->_configure($options);

        $repo = Repo::open($userName, $projecSlug);

        if ($repo && (count($repo->getBranches(true)) != 0)) {
            return $repo->getTree($this->branch, $this->path);
        }
        return null;
    }
}
