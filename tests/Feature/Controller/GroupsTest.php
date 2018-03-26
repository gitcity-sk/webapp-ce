<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Group;
use App\Project;
use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupsTest extends TestCase
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
    public function users_can_see_all_groups()
    {
        $response = $this->get('/groups');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_group_create_page()
    {
        $response = $this->get('/groups/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_one_groups()
    {
        $response = $this->get('/groups/' . $this->group->id);
        $response->assertStatus(200); 
        $response->assertSee($this->group->name);  
    }
}
