<?php

namespace App\Http\Controllers\Groups;

use App\Group;
use Illuminate\Http\Request;
use App\ee\License;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function index()
    {
        if (license_check('groups') == false) {
            abort(404);
        }

        return view('groups.index');
    }

    /**
     *
     */
    public function create()
    {
        if (license_check('groups') == false) {
            abort(404);
        }

        return view('groups.create');
    }

    public function show(Group $group)
    {
        if (license_check('groups') == false) {
            abort(404);
        }

        return view('groups.show', compact('group'));
    }

    public function store()
    {
        if (license_check('groups') == false) {
            abort(404);
        }

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
