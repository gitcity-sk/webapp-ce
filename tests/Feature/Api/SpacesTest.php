<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Space;
use App\User;
use App\Project;
use App\Profile;

class SpacesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        // Profile belongs to user so lets create user with profile
        $this->user = factory(User::class)->create();
        $this->space = factory(Space::class)->create(['user_id' => $this->user->id]);
        $this->project = factory(Project::class)->create(['user_id' => $this->user->id]);
        $this->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);

        $this->spaceName = 'My Space ' . time();

        $this->actingAs($this->user)->withSession(['_token' => 'test'])->post('/projects/' . $this->project->id . '/spaces', [
            'name' =>  $this->spaceName,
            '_token' => 'test'
        ]);
    }

    /** @test */
    public function api_can_get_files()
    {
        $response = $this->actingAs($this->user)->get('/spaces/' . str_slug($this->spaceName) . '/files');
        $response->assertStatus(200);
    }

    /** @test */
    public function api_can_get_directories()
    {
        $response = $this->actingAs($this->user)->get('/spaces/' . str_slug($this->spaceName) . '/directories');
        $response->assertStatus(200);
    }

    /** @test */
    public function api_can_get_space_size()
    {
        $response = $this->actingAs($this->user)->get('/spaces/' . str_slug($this->spaceName) . '/size');
        $response->assertStatus(200);
    }
}
