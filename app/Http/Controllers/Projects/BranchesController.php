<?php

namespace App\Http\Controllers\Projects;

use App\Project;
use App\Repo;
use App\Http\Controllers\Controller;

class BranchesController extends Controller
{
    public function show(Project $project)
    {
        if (auth()->user()->can('show-project')) {
                $repo = Repo::open($project->user->name, $project->slug);

            if ($repo && (count($repo->getBranches(true)) != 0)) {
                $branches = $repo->getBranches();
            } else {
                $branches = null;
            }

            return view('projects.branches', compact('project', 'branches'));
        }

        abort(403);
    }
}
