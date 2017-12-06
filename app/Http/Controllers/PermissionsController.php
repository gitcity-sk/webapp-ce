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

    public function index(Permission $permission)
    {
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Permission $permission)
    {
        Permission::create([
            'name' => request('name'),
            'label' => request('label')
        ]);

        return redirect('/admin/permissions');
    }

    public function assignTo(Role $role)
    {
        $permission = Permission::findOrFail(request('permission_id'));
        $role->givePermissionTo($permission);

        return back();
    }
}
