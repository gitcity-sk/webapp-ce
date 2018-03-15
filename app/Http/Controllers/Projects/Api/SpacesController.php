<?php

namespace App\Http\Controllers\Projects\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Http\Resources\SpaceResource;

class SpacesController extends Controller
{
    public function index(Project $project)
    {
        return SpaceResource::collection($project->spaces()->paginate());
    }
}
