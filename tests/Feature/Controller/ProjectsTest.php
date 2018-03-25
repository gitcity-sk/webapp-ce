<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;
use App\User;
use App\Permission;
use App\Role;
use App\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use SebastianBergmann\Comparator\Factory;

class ProjectsTest extends TestCase
{
    use DatabaseMigrations;
    // use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        // Pforile belongs to user so lets create user with profile
        $this->user = factory(User::class)->create();
        $this->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);

        // issue belongs to user
        $this->project = factory(Project::class)->create(['user_id' => $this->user->id]);
    }

    /** @test */
    public function users_can_see_all_projects()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects');
        $response->assertStatus(200);
        $response->assertSee('Projects');
    }

    /** @test */
    public function users_can_see_single_project()
    {
        $role = factory(Role::class)->create(['name' => 'administrator']);
        $showPerm = factory(Permission::class)->create(['name' => 'show-project']);
        $delPerm = factory(Permission::class)->create(['name' => 'delete-project']);
        $role->givePermissionTo($showPerm);
        $role->givePermissionTo($delPerm);
        $this->user->assignRole($role->name);

        //$this->user->hasRole($role->name);

        $response = $this->actingAs($this->user)
        ->get('/projects/' . $this->project->id);
        $response->assertStatus(403);
    }

    /** @test */
    public function users_can_see_project_issues()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/issues');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_commits()
    {
        $this->user->assignRole('administrator');

        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/commits');
        $response->assertStatus(403);
    }

    /** @test */
    public function users_can_see_project_branches()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/branches');
        $response->assertStatus(403);
    }

    /** @test */
    public function users_can_see_project_tags()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/tags');
        $response->assertStatus(403);
    }

    /** @test */
    public function users_can_see_project_merge_requests()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/merge-requests');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_merge_requests_create_form()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/merge-requests/new');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_crete_form()
    {
        $response = $this->actingAs($this->user)->get('/projects/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_view_issue_create_page()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/issues/new');
        $response->assertStatus(200);
    }
}
