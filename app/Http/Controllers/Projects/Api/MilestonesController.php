<?php

namespace App\Http\Controllers\Projects\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Http\Resources\MilestoneResource;

class MilestonesController extends Controller
{
    /**
     * MilestonesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Project $project
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Project $project)
    {
        return MilestoneResource::collection($project->milestones);
    }
}
