<?php

namespace App\Http\Controllers\Api;

use App\Project;
use App\Repositories\Projects;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;

class ProjectsController extends Controller {

    public function __construct(Projects $projects)
    {
        $this->middleware('auth');

        $this->projects = $projects;
    }

    public function index()
    {
        $projects = $this->projects->orderBy('created_at', 'desc');

        return ProjectResource::collection($projects);
    }
}