<?php

namespace Tests\Feature\Projects\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\MergeRequest;
use App\Profile;
use App\User;
use App\Project;

class MergeRequestsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        // Pforile belongs to user so lets create user with profile
        $this->user = factory(User::class)->create();
        $this->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);
        $this->project = factory(Project::class)->create(['user_id' => $this->user->id]);

        // issue belongs to user
        $this->mr = factory(MergeRequest::class)->create(['user_id' => $this->user->id, 'project_id' => $this->project->id]);
    }

    /** @test */
    public function api_can_get_merge_requests()
    {
        $response = $this->actingAs($this->user)->get('/api/projects/' . $this->project->id . '/merge-requests');
        $response->assertStatus(200);
        $response->assertSee($this->mr->title);
    }
}
