<?php

namespace App\Repositories;

use App\Issue;

/**
 * Issues Repository
 */
class issues
{
    public function all()
    {
        return Issue::all();
    }
}
