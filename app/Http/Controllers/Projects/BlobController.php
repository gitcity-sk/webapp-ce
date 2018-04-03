<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\View\View;

class BlobController extends Controller
{
    /**
     * @param Project $project
     * @param null $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Project $project, $path = null) : View
    {
        return view('projects.blob', compact('project', 'path'));
    }
}
