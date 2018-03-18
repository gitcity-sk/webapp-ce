<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;

class PermissionsController extends Controller
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
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Permission $permission)
    {
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Permission $permission)
    {
        Permission::create([
            'name' => request('name'),
            'label' => request('label')
        ]);

        return redirect('/admin/permissions');
    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignTo(Role $role)
    {
        $permission = Permission::findOrFail(request('permission_id'));
        $role->givePermissionTo($permission);

        return back();
    }
}
