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
     * ProjectsController constructor.
     * @param Projects $projects
     */
    public function __construct(Projects $projects)
    {
        $this->middleware('auth');

        $this->projects = $projects;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('projects.index');
    }

    /**
     * @param $id
     * @param null $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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

        abort(403, 'Not enough permission');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOnServer(Project $project)
    {
        $project->createOnServer();

        return back();
    }

    /**
     * @param CreateProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateProjectRequest $request)
    {
        auth()->user()->publish(
            new Project(request(['name', 'description']))
        );

        return redirect('/projects');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mergeRequests($id)
    {
        $project = $this->projects->findById($id);

        return view('projects.merge_requests', compact('project'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createMergeRequest($id)
    {
        $project = $this->projects->findById($id);

        return view('projects.new_merge_request', compact('project'));
    }
}
