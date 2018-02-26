<?php

namespace App\Http\Controllers\Projects;

use App\Project;
use App\Repo;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function show(Project $project)
    {
        if (auth()->user()->can('show-project')) {
            $repo = Repo::open($project->user->name, $project->slug);

            if ($repo && (count($repo->getBranches(true)) != 0)) {
                $tags = $repo->getTags();
            } else {
                $tags = null;
            }
            // dd($tree);

            return view('projects.tags', compact('project', 'tags'));
        }

        abort(403);
    }
}
