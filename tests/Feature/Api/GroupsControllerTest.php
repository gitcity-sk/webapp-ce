<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Group;
use App\Project;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupsControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $group = factory(Group::class)->create();

        $response = $this->get('/api/groups');
        $response->assertStatus(200);
        $response->assertSee($group->name);
        $response->assertSee($group->description);
        $response->assertSee($group->user->profile->name);
    }

    public function testProjects()
    {
        $group = factory(Group::class)->create();
        $project = factory(Project::class)->create();

        $group->projects()->save($project);

        $response = $this->get('/api/groups/' . $group->id . '/projects');
        $response->assertStatus(200);
        $response->assertSee($project->name);
        $response->assertSee($project->description);
    }
}
