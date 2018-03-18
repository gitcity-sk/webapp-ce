<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Project;
use App\Repo;
use App\Diff;
use App\MergeRequest;

class MergeRequestsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Project $project)
    {
        MergeRequest::create([
            'title' => request('title'),
            'description' => request('description'),
            'branch_to' => request('branch_to'),
            'branch_from' => request('branch_from'),
            'project_id' => $project->id,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('project', [$project]);
    }
}
