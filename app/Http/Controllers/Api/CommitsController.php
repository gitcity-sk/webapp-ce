<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Commit;
use App\Project;
use App\Http\Resources\Git\CommitResource;

class CommitsController extends Controller
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
    
    public function index(Project $project)
    {
        $gitLog = new Commit();
        $commits = $gitLog->get($project->user->name, $project->slug);

        return [
            'data' => CommitResource::collection($commits)
        ];
    }

    /**
     * Show single commit by sha
     */
    public function show(Project $project, $sha)
    {
        $gitLog = new Commit();
        $commit = $gitLog->getSingle($project->user->name, $project->slug, $sha);
        return [
            'data' => (new CommitResource($commit))->toArray()
        ];
    }
}
