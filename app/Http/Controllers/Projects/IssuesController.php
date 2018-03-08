<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Issue;
use App\Repositories\Projects;
use App\Http\Requests\CreateProjectIssueRequest;

class IssuesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Projects $projects)
    {
        $this->middleware('auth');

        $this->projects = $projects;
    }

    public function index($id)
    {
        $project = $this->projects->findById($id);

        return view('projects.issues', compact('project'));
    }

    public function create($id)
    {
        $project = $this->projects->findById($id);

        return view('projects.new_issue', compact('project'));
    }

    public function store(CreateProjectIssueRequest $request, Project $project)
    {
        Issue::create([
            'title' => request('title'),
            'description' => request('description'),
            'project_id' => $project->id,
            'user_id' => auth()->id(),
            'milestone_id' => request('milestone_id')
        ]);

        return redirect()->route('projectIssues', [$project]);
    }
}
