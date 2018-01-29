<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo;
use App\Tree;
use App\Project;

class TreeController extends Controller
{
    public function files(Project $project)
    {
        $treeGit = new Tree();
        $tree = $treeGit->get($project->user->name, $project->slug);

        //dd($tree);
        return $tree;
    }
}
