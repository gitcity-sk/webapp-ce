<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;

class MilestonesController extends Controller
{
    public function index(Group $group)
    {
        return view('groups.milestones.index', compact('group'));
    }

    public function store(Group $group)
    {
        //
    }
}
