<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;
use App\User;
use App\Issue;
use App\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectsControllerTest extends TestCase
{
    use DatabaseMigrations;

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
    public function api_can_get_all_projects()
    {
        $response = $this->actingAs($this->user)->get('/api/projects');
        $response->assertStatus(200);
        $response->assertSee($this->project->name);
        $response->assertSee($this->project->description);
        $response->assertSee($this->profile->name);
        $response->assertSee($this->project->slug);
    }

    /** @test */
    public function api_can_get_single_project()
    {
        $issues = factory(Issue::class)->create(['user_id' => $this->user->id]);
        $this->project->issues()->save($issues);

        $response = $this->actingAs($this->user)->get('/api/projects/' . $this->project->id . '/issues');
        $response->assertStatus(200);
        $response->assertSee($issues->title);
        $response->assertSee($issues->description);
        $response->assertSee($this->user->profile->name);
    }
}
