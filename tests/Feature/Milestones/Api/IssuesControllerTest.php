<?php

namespace Tests\Feature\Milestones\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Issue;
use App\User;
use App\Project;
use App\Milestone;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IssuesControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->project = factory(Project::class)->create();
        $this->milestone = factory(Milestone::class)->create([
            'project_id' => $this->project->id
        ]);

        $this->issue = factory(Issue::class)->create(['milestone_id' => $this->milestone->id]);
        $this->closed_issue = factory(Issue::class)->create(['milestone_id' => $this->milestone->id, 'complete' => 1]);
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
