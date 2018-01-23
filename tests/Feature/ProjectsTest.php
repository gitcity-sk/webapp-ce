<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;
    // use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects');
        $response->assertStatus(200);
    }

    public function view()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create;

        $response = $this->actingAs($user)
            ->withSession(['asd' => 'dsa'])
            ->get('/projects/' . $project->id);
        $response->assertStatus(200);

        $response->assertSee($project->name);
    }
}
