<?php

namespace App\Http\Controllers\Projects;

use App\Project;
use App\Http\Controllers\Controller;

class CommitsController extends Controller
{
    public function show(Project $project)
    {
        if (auth()->user()->can('show-project')) {

            return view('projects.commits', compact('project'));
        }

        abort(403);
    }
}
