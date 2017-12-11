<?php

namespace App\Http\Controllers;

use App\Project;
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

    public function show(MergeRequest $mergeRequest)
    {
        return view('merge_requests.show', compact('mergeRequest'));
    }

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
