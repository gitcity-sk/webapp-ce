<?php

namespace App\Http\Controllers\Projects\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blob;
use App\Project;

class ReadmeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'throttle:60,1']);
    }

    public function show(Project $project)
    {
        $blob = new Blob();

        return [
            'data' => $blob->get($project->user->name, $project->slug, [
                'branch' => 'master',
                'path' => 'README.md'
            ])
        ];
    }
}
