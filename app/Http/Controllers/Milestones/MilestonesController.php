<?php

namespace App\Http\Controllers\Milestones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Milestone;

class MilestonesController extends Controller
{
    /**
     * MilestonesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Milestone $milestone
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Milestone $milestone)
    {
        $completed_percentage = 0;
        
        if ($milestone->issues()->count()) $completed_percentage = floor(($milestone->issues()->closed()->count() / $milestone->issues()->count()) * 100);

        return view('milestones.show', compact('milestone', 'completed_percentage'));
    }
}
