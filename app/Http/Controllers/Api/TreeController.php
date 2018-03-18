<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo;
use App\Tree;
use App\Project;
use App\Http\Resources\Git\TreeResource;

class TreeController extends Controller
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
     * @param null $path
     * @return array
     * @throws \Exception
     */
    public function files(Project $project, $path = null)
    {
        $treeGit = new Tree();
        $tree = $treeGit->get($project->user->name, $project->slug, [
            'path' => $path
        ]);
        
        return [
            'data' => TreeResource::collection($tree)
        ];
    }
}
