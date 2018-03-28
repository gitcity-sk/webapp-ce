<?php

namespace App\Http\Controllers\Projects\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blob;
use App\Project;

class ReadmeController extends Controller
{
    public function show(Project $project, $path = null)
    {
        $blob = new Blob();

        return $blob->get($project->user->name, $project->slug, [
            'path' => 'README.md'
        ]);
    }
}
