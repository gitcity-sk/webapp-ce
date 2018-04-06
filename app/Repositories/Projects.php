<?php

namespace App\Repositories;

use App\Project;
use App\User;

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

    /**
     * @param null|string $projectPath
     */
    public function findFromPath($projectPath)
    {
        $matches = explode('/', $projectPath);
        $user = User::where('name', $matches[0])->firstOrFail();

        if ($user) {
            return $user->projects()->where('slug', $matches[1])->firstOrFail();
        }

        return null;
    }
}
