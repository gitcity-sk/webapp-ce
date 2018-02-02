<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Project;
use App\Role;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/api/users');
        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $user->assignRole($role->name);

        $response = $this->actingAs($user)->get('/api/users/' . $user->id);
        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee($user->email);
        $response->assertSee($role->name);
    }

    public function testProjects()
    {
        $project = factory(Project::class)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->json('GET', '/api/users/' . $project->user_id . '/projects');
        $response->assertStatus(200);
        $response->assertSee($project->name);
        $response->assertSee($project->description);
        $response->assertSee($project->user->profile->name);
    }
}
