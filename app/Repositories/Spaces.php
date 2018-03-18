<?php

namespace App\Repositories;

use App\Space;

class Spaces
{
    /**
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findBySlug($slug)
    {
        return Space::where('slug', $slug)->firstOrFail();
    }
}
