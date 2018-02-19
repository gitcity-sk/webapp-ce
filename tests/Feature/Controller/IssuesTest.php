<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Issue;
use App\User;
use App\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IssuesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        // Pforile belongs to user so lets create user with profile
        $this->user = factory(User::class)->create();
        $this->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);

        // issue belongs to user and project
        $this->issue = factory(Issue::class)->create(['user_id' => $this->user->id]);
    }

    /** @test */
    public function users_can_view_single_issue()
    {
        $response = $this->actingAs($this->issue->user)
            ->withSession(['asd' => 'dsa'])
            ->get('/issues/' . $this->issue->id);
        $response->assertStatus(200);
        $response->assertSee($this->issue->title);
        $response->assertSee($this->issue->project->name);
        $response->assertSee($this->issue->user->profile->name);
    }
}
