<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Traits\RequireAuthenticationTrait;

class UsersController extends Controller
{
    use RequireAuthenticationTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (!auth()->user()->can('do:admin:actions')) {
            abort(403, 'You do not have permission to see this page');
        }

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        if (!auth()->user()->can('do:admin:actions')) {
            abort(403, 'You do not have permission to see this page');
        }

        $roles = Role::all();

        return view('admin.users.show', compact('user', 'roles'));
    }
}
