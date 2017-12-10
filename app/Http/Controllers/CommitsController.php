<?php

namespace App\Http\Controllers;

use App\Project;
use App\Repo;

class CommitsController extends Controller
{
    public function show(Project $project)
    {
        if (auth()->user()->can('show-project')) {

            $repo = null;

            if ($repo && (count($repo->getBranches(true)) != 0)) {
                $repo = Repo::open($project->user->name, $project->slug);
                $commits = $repo->getLog('HEAD');
            } else {
                $commits = null;
            }
            // dd($tree);

            return view('projects.commits', compact('project', 'commits'));
        }

        return view('pages.403');
    }
}
