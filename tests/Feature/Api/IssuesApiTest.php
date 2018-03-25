<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Issue;
use App\User;
use App\Profile;
use App\Milestone;
use App\Project;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IssuesControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        // Pforile belongs to user so lets create user with profile
        $this->user = factory(User::class)->create();
        $this->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);
        $this->project = factory(Project::class)->create();
        $this->milestone = factory(Milestone::class)->create([
            'project_id' => $this->project->id
        ]);

        // issue belongs to user
        $this->issue = factory(Issue::class)->create(['user_id' => $this->user->id, 'milestone_id' => $this->milestone->id]);
        $this->closed_issue = factory(Issue::class)->create(['milestone_id' => $this->milestone->id, 'complete' => 1]);
    }

    /** @test */
    public function api_can_get_all_issues()
    {
        $response = $this->get('/api/issues');
        $response->assertStatus(200);
        $response->assertSee($this->issue->title);
        $response->assertSee($this->issue->description);
        $response->assertSee($this->issue->user->profile->name);
        $response->assertSee($this->issue->project->name);
    }

    /** @test */
    public function api_can_get_single_issue()
    {
        $response = $this->get('/api/issues/' . $this->issue->id);
        $response->assertStatus(200);
        $response->assertSee($this->issue->title);
        $response->assertSee($this->issue->description);
        $response->assertSee($this->issue->user->profile->name);
        $response->assertSee($this->issue->project->name);
    }

    /** @test */
    public function api_can_get_open_issues()
    {
        $response = $this->actingAs($this->user)->get('/api/milestones/' . $this->milestone->id . '/issues/open' );
        $response->assertStatus(200);
        $response->assertSee($this->issue->title);

    }

    /** @test */
    public function api_can_get_closed_issues()
    {
        $response = $this->actingAs($this->user)->get('/api/milestones/' . $this->milestone->id . '/issues/closed' );
        $response->assertStatus(200);
        $response->assertSee($this->closed_issue->title);
    }
}
