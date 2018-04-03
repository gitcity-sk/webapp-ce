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
    public function users_can_see_single_project_no_permission()
    {
        $response = $this->actingAs($this->user)
            ->get('/projects/' . $this->project->id);
        $response->assertStatus(403);
    }

    /** @test */
    public function users_can_see_single_project_with_permission()
    {
        $userWithPermission = $this->createUserWithPermissionTo('show-project');
        $this->assertTrue($userWithPermission->can('show-project'));

        // can see with permission
        $response = $this->actingAs($userWithPermission)
            ->get('/projects/' . $this->project->id);
        $response->assertStatus(200);
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
    public function users_can_see_project_commits_no_permission()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/commits');
        $response->assertStatus(403);
    }

    /** @test */
    public function users_can_see_project_commits_with_permission()
    {
        $userWithPermission = $this->createUserWithPermissionTo('show-project');
        $this->assertTrue($userWithPermission->can('show-project'));

        $response = $this->actingAs($userWithPermission)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/commits');
        $response->assertStatus(200);
    }


    /** @test */
    public function users_can_see_project_branches_no_permission()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/branches');
        $response->assertStatus(403);
    }

    /** @test */
    public function users_can_see_project_branches_with_permission()
    {
        $userWithPermission = $this->createUserWithPermissionTo('show-project');
        $this->assertTrue($userWithPermission->can('show-project'));

        $response = $this->actingAs($userWithPermission)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/branches');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_project_tags_no_permission()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/tags');
        $response->assertStatus(403);
    }

    /** @test */
    public function users_can_see_project_tags_with_permission()
    {
        $userWithPermission = $this->createUserWithPermissionTo('show-project');
        $this->assertTrue($userWithPermission->can('show-project'));

        $response = $this->actingAs($userWithPermission)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/tags');
        $response->assertStatus(200);
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

    /** @test */
    public function users_can_view_blob_page()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $this->project->id . '/blob/path/to/blob');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_project_without_rights()
    {
        $projectName = 'My Project';

        $response = $this->actingAs($this->user)->withSession(['_token' => 'test'])->post('/projects', [
            'name' =>  $projectName,
            'description' => 'Hello world',
            '_token' => 'test'
        ]);
        $response->assertStatus(403);
    }

    /** @test */
    public function user_can_create_project_with_rights()
    {
        $projectName = 'My Project';
        $userWithRights = $this->createUserWithPermissionTo('create-project');

        $response = $this->actingAs($userWithRights)->withSession(['_token' => 'test'])->post('/projects', [
            'name' =>  $projectName,
            'description' => 'Hello world',
            '_token' => 'test'
        ]);
        $response->assertRedirect('/projects');

        $project = Project::where('name', $projectName)->first();
        $this->assertEquals($projectName, $project->name);
    }
}
