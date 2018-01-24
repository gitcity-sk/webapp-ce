<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Issue;
use App\User;

class IssuesController extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShow()
    {
        $issue = factory(Issue::class)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/issues/' . $issue->id);
        $response->assertStatus(200);
        $response->assertSee($issue->title);
        $response->assertSee($issue->project->name);
        $response->assertSee($issue->user->name);
    }
}
