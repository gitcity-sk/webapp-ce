<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class PermissionsSeeder extends Seeder
{
    protected $permissions = [
        ['name' => 'show-project', 'label' => 'Can show project'],
        ['name' => 'create-project', 'label' => 'Can create project'],
        ['name' => 'create-issue', 'label' => 'Can create issue'],
        ['name' => 'create-comment', 'label' => 'Can create comment'],
        ['name' => 'show-space', 'label' => 'Can show space'],
        ['name' => 'show-create', 'label' => 'Can create space'],
        ['name' => 'show-project', 'label' => 'Can show project'],
        ['name' => 'assign-permission', 'label' => 'Can assign permission to role']
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // projects
        /*$role = factory(Role::class)->create(['name' => 'Administrator']);
        foreach ($this->permissions as $permission)
        {
            $perm = factory(Permission::class)->create([
                'name' => $permission['name'],
                'label' => $permission['label']
            ]);

            $role->givePermissionTo($perm);
        }*/
    }
}
