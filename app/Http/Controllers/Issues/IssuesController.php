<?php

namespace App\Http\Controllers\Issues;

use App\Project;
use App\Issue;
use App\Repositories\Issues;
use App\Http\Controllers\Controller;

class IssuesController extends Controller
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
     * @param Issue $issue
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Issue $issue)
    {
        return view('issues.show', compact('issue'));
    }
}
