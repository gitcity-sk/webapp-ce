<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index()
    {
        return view('groups.index');
    }

    /**
     *
     */
    public function create()
    {
        return view('groups.create');
    }

    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);

        auth()->user()->publishGroup(
            new Group(request(['name', 'description']))
        );

        return redirect('/groups');
    }

}
