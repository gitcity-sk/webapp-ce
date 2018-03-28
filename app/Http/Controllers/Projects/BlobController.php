<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class BlobController extends Controller
{
    public function show(Project $project, $path = null)
    {
        return view('projects.blob', compact('project', 'path'));
    }
}
