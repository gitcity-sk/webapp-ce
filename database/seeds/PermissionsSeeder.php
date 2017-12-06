<?php

use Illuminate\Database\Seeder;

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
        DB::table('permissions')->insert($this->permissions);
    }
}
