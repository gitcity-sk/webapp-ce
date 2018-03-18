<?php

namespace App\Http\Controllers\MergeRequests\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DiffObject;
use App\Project;
use App\Http\Resources\Git\DiffObjectResource;

class DiffController extends Controller
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
     * @param $sourceBranch
     * @param $targetBranch
     * @return array
     */
    public function index(Project $project, $sourceBranch, $targetBranch)
    {
        $diffObjects = new DiffObject();
        $diff = $diffObjects->get($project->user->name, $project->slug, $sourceBranch, $targetBranch);
        // dd($diff);

        return ['data' => DiffObjectResource::collection($diff)];
    }
}
