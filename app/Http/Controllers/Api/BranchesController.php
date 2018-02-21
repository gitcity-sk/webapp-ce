<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Branch;
use App\Http\Resources\Git\BranchesResource;

class BranchesController extends Controller
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
        $gitBranches = new Branch();
        $branches = $gitBranches->get($project->user->name, $project->slug);

        // branches returns array of gitObject
        $array = [];
        foreach ($branches as $branch) {
            $array[] = (new BranchesResource($branch))->toArray();
        }

        return [
            'data' => $array
        ];
    }
}
