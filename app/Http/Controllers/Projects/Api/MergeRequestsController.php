<?php

namespace App\Http\Controllers\Projects\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Http\Resources\MergeRequestResource;

class MergeRequestsController extends Controller
{
    /**
     * MergeRequestsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Project $project
     * @return array
     */
    public function index(Project $project)
    {
        return ['data' => MergeRequestResource::collection($project->mergeRequests)];
    }
}
