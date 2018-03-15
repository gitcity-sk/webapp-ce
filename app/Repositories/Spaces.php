<?php

namespace App\Repositories;

use App\Space;

class Spaces
{
    public function findBySlug($slug)
    {
        return Space::where('slug', $slug)->firstOrFail();
    }
}
