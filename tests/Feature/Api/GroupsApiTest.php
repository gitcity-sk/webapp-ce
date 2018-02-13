<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Group;
use App\Project;
use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        // Pforile belongs to user so lets create user with profile
        $this->user = factory(User::class)->create();
        $this->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);
        
        // Group belongs to user
        $this->group = factory(Group::class)->create(['user_id' => $this->user->id]);
        
    }
    
    /** @test */
    public function api_can_get_all_groups()
    {
        $response = $this->get('/api/groups');
        $response->assertStatus(200);
        $response->assertSee($this->group->name);
        $response->assertSee($this->group->description);
        $response->assertSee($this->group->user->profile->name);
    }

    /** @test */
    public function api_can_get_group_projects()
    {
        $project = factory(Project::class)->create();
        $this->group->projects()->save($project);

        $response = $this->get('/api/groups/' . $this->group->id . '/projects');
        $response->assertStatus(200);
        $response->assertSee($project->name);
        $response->assertSee($project->description);
    }
}
