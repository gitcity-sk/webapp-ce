<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Project\ProjectIndexResource;

class UsersController extends Controller
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
     * @return array
     */
    public function index()
    {
        $users = User::all();

        return compact('users');
    }

    /**
     * @param User $user
     * @return array
     */
    public function show(User $user)
    {
        $roles = Role::all();

        return compact('user', 'roles');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function projects(User $user)
    {
        return ProjectIndexResource::collection($user->projects);
    }
}
