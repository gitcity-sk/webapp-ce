<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Milestone;
use App\User;
use App\Profile;
use App\Project;

class MilestonesControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->project = factory(Project::class)->create(['user_id' => $this->user->id]);
        $this->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);
        $this->milestone = factory(Milestone::class)->create([
            'project_id' => $this->project->id
        ]);
    }

    /** @test */
    public function user_can_see_project_milestones()
    {
        $response = $this->get('/projects/' . $this->project->id . '/milestones');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_see_group_milestones()
    {
        $response = $this->get('/groups/' . $this->milestone->group->id . '/milestones');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_project_milestones()
    {
        $response = $this->get('/projects/' . $this->project->id . '/milestones/new');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_group_milestones()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /** @test */
    public function user_can_show_milestone()
    {
        $response = $this->actingAs($this->user)->get('/milestones/' . $this->milestone->id);
        $response->assertStatus(200);
        $response->assertSee($this->milestone->title);
    }
}
