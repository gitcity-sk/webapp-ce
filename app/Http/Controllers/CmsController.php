<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class CmsController extends Controller
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
        return view('cms.index');
    }
}
