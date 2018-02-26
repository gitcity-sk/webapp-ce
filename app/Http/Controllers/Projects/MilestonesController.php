<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Milestone;

class MilestonesController extends Controller
{
    public function index(Project $project)
    {
        return view('projects.milestones.index', compact('project'));
    }

    public function create(Project $project)
    {
        return view('projects.milestones.create', compact('project'));
    }

    public function store(Project $project)
    {
        $project->milestones()->save(new Milestone([
            'title' => request('title'),
            'description' => request('description')
        ]));

        return redirect()->route('projectMilestones', [$project]);
    }
}
