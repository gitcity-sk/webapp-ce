<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Project;
use App\Role;
use App\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        // Pforile belongs to user so lets create user with profile
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function api_can_get_all_users()
    {
        $response = $this->actingAs($this->user)->get('/api/users');
        $response->assertStatus(200);
        $response->assertSee($this->user->name);
        $response->assertSee($this->user->email);
    }

    /** @test */
    public function api_can_get_single_user()
    {
        $role = factory(Role::class)->create();
        $this->user->assignRole($role->name);

        $response = $this->actingAs($this->user)->get('/api/users/' . $this->user->id);
        $response->assertStatus(200);
        $response->assertSee($this->user->name);
        $response->assertSee($this->user->email);
        $response->assertSee($this->user->name);
    }

    /** @test */
    public function api_can_get_user_projects()
    {
        $profile = factory(Profile::class)->create(['user_id' => $this->user->id]);
        $project = factory(Project::class)->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->json('GET', '/api/users/' . $project->user_id . '/projects');
        $response->assertStatus(200);
        $response->assertSee($project->name);
        $response->assertSee($project->description);
        $response->assertSee($this->user->profile->name);
    }
}
