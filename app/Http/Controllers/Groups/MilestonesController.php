<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;

class MilestonesController extends Controller
{
    /**
     * @param Group $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Group $group)
    {
        return view('groups.milestones.index', compact('group'));
    }

    /**
     * @param Group $group
     */
    public function store(Group $group)
    {
        //
    }
}
