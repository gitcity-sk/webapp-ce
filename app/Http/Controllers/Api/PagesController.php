<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class PagesController extends Controller
{
    public function index(Project $project)
    {
        //dd ($project->pages);

        return $project->pages;
    }
}
