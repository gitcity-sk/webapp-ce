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
        $treex = new Tree();
        $tree = $treex->get($project->user->name, $project->slug);

        return $tree->toArray();
    }
}
