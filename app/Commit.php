<?php

namespace App;

use App\Repositories\Projects;
use App\Api\Git\BaseModel;

class Commit extends BaseModel
{
    public function get($userName, $projecSlug)
    {
        $repo = Repo::open($userName, $projecSlug);

        if ($repo && (count($repo->getBranches(true)) != 0)) {
            return $repo->getLog('HEAD');
        }
        return null;
    }
}