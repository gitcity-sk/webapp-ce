<?php

namespace App\Repositories;

use App\Project;

class Projects
{
    public function all()
    {
        return Project::all();
    }

    public function orderBy($field, $method)
    {
        return Project::orderBy($field, $method)->get();
    }

    public function findById($id)
    {
        return Project::findOrFail($id);
    }
}
