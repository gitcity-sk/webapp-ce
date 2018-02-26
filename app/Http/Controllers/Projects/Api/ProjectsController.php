<?php

namespace App\Http\Controllers\Projects\Api;

use App\Project;
use App\Repositories\Projects;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\IssueResource;

class ProjectsController extends Controller
{

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

    public function issues(Project $project)
    {
        return IssueResource::collection($project->issues);
    }
}
