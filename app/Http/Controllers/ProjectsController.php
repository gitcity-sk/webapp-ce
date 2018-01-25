<?php

namespace App\Http\Controllers;

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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     */
    public function index(Projects $projects)
    {

        $projects = $projects->orderBy('created_at', 'desc');

        return view('projects.index', compact('projects'));
    }

    /**
     *
     */
    public function show(Project $project) // Project::find(wildcard) wildcaard is name in routes so project and must be same as in controller
    {
        // setup required variables
        $tree = null;
        $readme = null;

        if (auth()->user()->can('show-project')) {

            //$treex = new Tree();

            //$tree = $treex->get($project->user->name, $project->slug);

            return view('projects.show', compact('project'));

            return $tree->toArray();
        }

        return view('pages.403');
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
    public function issues(Project $project)
    {
        return view('projects.issues', compact('project'));
    }

    public function mergeRequests(Project $project)
    {
        return view('projects.merge_requests', compact('project'));
    }

    public function createMergeRequest(Project $project)
    {
        return view('projects.new_merge_request', compact('project'));
    }
}
