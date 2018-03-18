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
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $roles = Role::all();

        return view('admin.users.show', compact('user', 'roles'));
    }
}
