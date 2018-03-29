<?php

namespace App\Http\Controllers\Git\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Project\ProjectResource;
use App\Git\Shell;
use App\Repositories\Projects;

class HooksController extends Controller
{
    public function __construct(Projects $projects)
    {
        $this->projects = $projects;
    }

    /**
     * Return project information
     */
    public function update()
    {
        if (!Shell::isAllowed(request('shell_secret_key'))) abort(404);

        $project = $this->projects->findFromPath(request('project'));
        
        return new ProjectResource($project);
    }
}
