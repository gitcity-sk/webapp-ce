<?php

namespace App\Http\Controllers\Projects\Api;

use App\Project;
use App\Repositories\Projects;
use App\Http\Controllers\Controller;
use App\Http\Resources\IssueResource;
use App\Http\Resources\Project\ProjectIndexResource;

class ProjectsController extends Controller
{

    /**
     * ProjectsController constructor.
     * @param Projects $projects
     */
    public function __construct(Projects $projects)
    {
        $this->middleware('auth');

        $this->projects = $projects;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $projects = $this->projects->orderBy('created_at', 'desc');

        return ProjectIndexResource::collection($projects);
    }

    /**
     * @param Project $project
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function issues(Project $project)
    {
        return IssueResource::collection($project->issues()->paginate());
    }
}
