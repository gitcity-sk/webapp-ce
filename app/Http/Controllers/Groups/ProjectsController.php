<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Group;

class ProjectsController extends Controller
{
    /**
     * @param Group $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Group $group)
    {
        $project = Project::findOrFail(request('project_id'));
        $group->attachProject($project);

        return back();
    }
}
