<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Space;
use Illuminate\Support\Facades\Storage;

class SpacesController extends Controller
{
    /**
     * ProjectsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Project $project)
    {
        return view('projects.spaces.index', compact('project'));
    }

    /**
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Project $project)
    {
        if (license_check('private_spaces') == false && request('private') == true) abort(403, 'License required');

        $spaceName = request('name');

        $space = $project->createSpace(new Space([
            'name' => $spaceName,
            'user_id' => auth()->id(),
            'slug' => str_slug($spaceName)
        ]));

        if($space) Storage::makeDirectory('spaces/' . $space->slug);

        return redirect()->route('project.spaces', [$project]);
    }
}
