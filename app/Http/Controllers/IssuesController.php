<?php

namespace App\Http\Controllers;

use App\Project;
use App\Issue;
use App\Repositories\Issues;

class IssuesController extends Controller
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

    public function show(Issue $issue)
    {
        return view('issues.show', compact('issue'));
    }

    public function store(Project $project)
    {
        Issue::create([
            'title' => request('title'),
            'description' => request('description'),
            'project_id' => $project->id,
            'user_id' => auth()->id()
        ]);

        return back();
    }
}
