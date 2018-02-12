<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Issue;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IssuesControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $issue = factory(Issue::class)->create();

        $response = $this->get('/api/issues');
        $response->assertStatus(200);
        $response->assertSee($issue->title);
        $response->assertSee($issue->description);
        $response->assertSee($issue->user->profile->name);
        $response->assertSee($issue->project->name);
    }

    public function testhow()
    {
        $issue = factory(Issue::class)->create();

        $response = $this->get('/api/issues/' . $issue->id);
        $response->assertStatus(200);
        $response->assertSee($issue->title);
        $response->assertSee($issue->description);
        $response->assertSee($issue->user->profile->name);
        $response->assertSee($issue->project->name);
    }
}
