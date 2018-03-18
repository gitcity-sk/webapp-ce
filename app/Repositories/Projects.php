<?php

namespace App\Repositories;

use App\Project;

class Projects
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Project::all();
    }

    /**
     * @param $field
     * @param $method
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function orderBy($field, $method)
    {
        return Project::orderBy($field, $method)->paginate(15);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findById($id)
    {
        return Project::findOrFail($id);
    }
}
