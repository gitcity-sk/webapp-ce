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

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Role $role)
    {
        if (!auth()->user()->can('do:admin:actions')) abort (403, 'You do not have permission to see this page');

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Role $role)
    {
        if (auth()->user()->can('assign-permissions') or (auth()->id() === 1) or auth()->user()->can('do:admin:actions')) {
            $permissions = Permission::all();

            return view('admin.roles.show', compact('role', 'permissions'));
        }

        return view('pages.403');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (!auth()->user()->can('do:admin:actions')) abort (403, 'You do not have permission to see this page');

        return view('admin.roles.create');
    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Role $role)
    {
        // Todo this is admin action?
        // dd(request());
        Role::create([
            'name' => request('name'),
            'label' => request('label')
        ]);

        return redirect('/admin/roles');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignTo(User $user)
    {
        // TODO this is admin action?
        // dd(request('role_id'));
        $user->assignRole(request('role_name'));

        return back();
    }
}
