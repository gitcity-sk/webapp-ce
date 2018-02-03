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
    use DatabaseTransactions;
    // use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects');
        $response->assertStatus(200);
        $response->assertSee('Projects');
    }

    public function testShow()
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

    public function testIssues()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/issues');
        $response->assertStatus(200);
    }

    public function testCommits()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/commits');
        $response->assertStatus(200);
    }

    public function testBranches()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/branches');
        $response->assertStatus(200);
    }

    public function testTags()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/tags');
        $response->assertStatus(200);
    }

    public function testMergeRequests()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/merge-requests');
        $response->assertStatus(200);
    }

    public function testMergeRequestsCreate()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id . '/merge-requests/new');
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/projects/create');
        $response->assertStatus(200);
    }
}
