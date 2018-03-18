<?php

namespace App\Http\Controllers\Groups;

use App\Group;
use Illuminate\Http\Request;
use App\ee\License;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (license_check('groups') == false) {
            abort(403, 'License required');
        }

        return view('groups.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (license_check('groups') == false) {
            abort(403, 'License required');
        }

        return view('groups.create');
    }

    /**
     * @param Group $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Group $group)
    {
        if (license_check('groups') == false) {
            abort(403, 'License required');
        }

        return view('groups.show', compact('group'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        if (license_check('groups') == false) {
            abort(403, 'License required');
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
