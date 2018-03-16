<?php

namespace App\Http\Controllers\Projects;

use App\Group;
use App\Project;
use App\Repo;
use App\Tree;
use App\Repositories\Projects;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;

class ProjectsController extends Controller
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

    /**
     *
     */
    public function index()
    {
        return view('projects.index');
    }

    /**
     *
     */
    public function show($id, $path = null) // Project::find(wildcard) wildcaard is name in routes so project and must be same as in controller
    {
        // setup required variables
        $tree = null;
        $readme = null;

        if (auth()->user()->can('show-project')) {
            $project = $this->projects->findById($id);

            return view('projects.show', compact('project', 'path'));
        }

        abort(403);
    }

    /**
     *
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * 
     */
    public function createOnServer(Project $project)
    {
        $project->createOnServer();

        return back();
    }

    /**
     *
     */
    public function store(CreateProjectRequest $request)
    {
        auth()->user()->publish(
            new Project(request(['name', 'description']))
        );

        return redirect('/projects');
    }

    /**
     * 
     */
    public function mergeRequests($id)
    {
        $project = $this->projects->findById($id);

        return view('projects.merge_requests', compact('project'));
    }

    /**
     * 
     */
    public function createMergeRequest($id)
    {
        $project = $this->projects->findById($id);

        return view('projects.new_merge_request', compact('project'));
    }
}
