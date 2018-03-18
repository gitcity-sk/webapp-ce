<?php

namespace App\Repositories;

use App\Issue;

/**
 * Issues Repository
 */
class issues
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Issue::all();
    }
}
