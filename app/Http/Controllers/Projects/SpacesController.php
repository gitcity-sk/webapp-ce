<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Space;
use Illuminate\Support\Facades\Storage;

class SpacesController extends Controller
{
    public function index(Project $project)
    {
        return view('projects.spaces.index', compact('project'));
    }

    public function store(Project $project)
    {
        // dd(config('webapp.spaces.path'));
        $spaceName = request('name');
        $space =  $project->spaces()->save(new Space([
            'name' => $spaceName,
            'user_id' => auth()->id(),
            'slug' => str_slug($spaceName)
        ]));

        if($space) Storage::makeDirectory('spaces/' . $space->slug);

        return redirect('/projects');
    }
}
