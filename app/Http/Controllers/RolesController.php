<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\User;

class RolesController extends Controller
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

    public function index(Role $role)
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    public function show(Role $role)
    {
        if (auth()->user()->can('assign-permissions') or (auth()->id() === 1)) {
            $permissions = Permission::all();
            return view('admin.roles.show', compact('role', 'permissions'));
        }

        return view('pages.403');
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Role $role)
    {
        // dd(request());
        Role::create([
            'name' => request('name'),
            'label' => request('label')
        ]);

        return redirect('/admin/roles');
    }

    public function assignTo(User $user)
    {
        // dd(request('role_id'));
        $user->assignRole(request('role_name'));

        return back();
    }
}
