<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;
use App\User;
use App\Permission;
use App\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use SebastianBergmann\Comparator\Factory;

class ProjectsControllerTest extends TestCase
{
    use DatabaseMigrations;
    // use DatabaseTransactions;
    

    /** @test */
    public function users_can_see_all_projects()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects');
        $response->assertStatus(200);
        $response->assertSee('Projects');
    }

    /** @test */
    public function users_can_see_single_project()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $role = factory(Role::class)->create();
        $showPerm = factory(Permission::class)->create(['name' => 'show-project']);
        $delPerm = factory(Permission::class)->create(['name' => 'delete-project']);
        $role->givePermissionTo($showPerm);
        $role->givePermissionTo($delPerm);
        $user->assignRole($role->name);

        $response = $this->actingAs($user)
        ->get('/projects/' . $project->id);
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_issues()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/issues');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_commits()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/commits');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_branches()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/branches');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_tags()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/tags');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_merge_requests()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/merge-requests');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_merge_requests_create_form()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/merge-requests/new');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_crete_form()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/projects/create');
        $response->assertStatus(200);
    }
}
