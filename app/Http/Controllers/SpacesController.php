<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Space;

class SpacesController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Project $project)
    {
        return view('spaces.create', compact('project'));
    }

    /**
     * @param Space $space
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getFile(Space $space, $file)
    {
        return response()->download(storage_path('app/spaces/'. $space->slug . '/' . $file), null, [], null);
    }
}
