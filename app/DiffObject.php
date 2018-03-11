<?php

namespace App;

use App\Repositories\Projects;
use App\Api\Git\BaseModel;

class DiffObject extends BaseModel
{
    public function get($userName, $projecSlug, $sourceBranch, $targetBranch)
    {
        $repo = Repo::open($userName, $projecSlug);

        if ($repo && (count($repo->getBranches(true)) != 0)) {
            return $repo->getDiff($repo->getCommit($repo->getBranch($sourceBranch)->getSha()), $repo->getCommit($repo->getBranch($targetBranch)->getSha()));
        }
        return null;
    }
}