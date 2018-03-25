<?php

namespace App\Http\Controllers\Projects;

use App\Project;
use App\Repo;
use App\Http\Controllers\Controller;

class BranchesController extends Controller
{
    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Project $project)
    {
        if (auth()->user()->can('show-project')) {

            return view('projects.branches', compact('project'));
        }

        abort(403);
    }
}
