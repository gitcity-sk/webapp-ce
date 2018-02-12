<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;
use App\User;
use App\Issue;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectsControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $project = factory(Project::class)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/api/projects');
        $response->assertStatus(200);
        $response->assertSee($project->name);
        $response->assertSee($project->description);
        $response->assertSee($project->user->profile->name);
        $response->assertSee($project->slug);
    }

    public function testIssues()
    {
        $project = factory(Project::class)->create();
        $user = factory(User::class)->create();

        $issues = factory(Issue::class)->create();
        $project->issues()->save($issues);

        $response = $this->actingAs($user)->get('/api/projects/' . $project->id . '/issues');
        $response->assertStatus(200);
        $response->assertSee($issues->title);
        $response->assertSee($issues->description);
        $response->assertSee($issues->user->profile->name);
    }
}
