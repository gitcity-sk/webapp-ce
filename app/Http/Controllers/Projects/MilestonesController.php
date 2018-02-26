<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class MilestonesController extends Controller
{
    public function index(Project $project)
    {
        return view('projects.milestones.index', compact('project'));
    }
}
