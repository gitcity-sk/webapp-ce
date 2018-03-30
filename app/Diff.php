<?php

namespace App;

use GitElephant\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * @deprecated Use DiffObject instead of Diff
 */
class Diff extends Model
{
    /**
     * @param $sourceBranch
     * @param $targetBranch
     * @param $repository
     * @return null
     */
    public static function getDiffBetween($sourceBranch, $targetBranch, $repository)
    {
        if ($repository && (count($repository->getBranches(true)) != 0)) {
            $diff = $repository->getDiff($repository->getCommit($repository->getBranch($sourceBranch)->getSha()), $repository->getCommit($repository->getBranch($targetBranch)->getSha()));
        } else {
            $diff = null;
        }
        // dd($diff);

        return $diff;
    }
}
