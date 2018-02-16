<?php

namespace App\Http\Controllers;

use App\Group;
use App\Project;
use App\Repo;
use App\Tree;
use App\Repositories\Projects;
use Illuminate\Support\Facades\Gate;

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

        $projects = $this->projects->orderBy('created_at', 'DESC');

        return view('projects.index', compact('projects'));
    }

    /**
     *
     */
    public function show($id) // Project::find(wildcard) wildcaard is name in routes so project and must be same as in controller
    {
        // setup required variables
        $tree = null;
        $readme = null;

        if (auth()->user()->can('show-project')) {
            $project = $this->projects->findById($id);

            return view('projects.show', compact('project'));
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

    public function createOnServer(Project $project)
    {
        $project->createOnServer();
        return back();
    }

    /**
     *
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);

        auth()->user()->publish(
            new Project(request(['name', 'description']))
        );

        /*Project::create([
            'name' => request('name'),
            'description' => request('description'),
            'user_id' => auth()->id()
        ]);*/

        return redirect('/projects');
    }

    /**
     *
     */
    public function issues($id)
    {
        $project = $this->projects->findById($id);
        return view('projects.issues', compact('project'));
    }

    public function mergeRequests($id)
    {
        $project = $this->projects->findById($id);
        return view('projects.merge_requests', compact('project'));
    }

    public function createMergeRequest($id)
    {
        $project = $this->projects->findById($id);
        return view('projects.new_merge_request', compact('project'));
    }

    public function createIssue($id)
    {
        $project = $this->projects->findById($id);
        return view('projects.new_issue', compact('project'));
    }

    public function assignTo(Group $group)
    {
        $project = Project::findOrFail(request('project_id'));
        $group->attachProject($project);

        return back();
    }
}
