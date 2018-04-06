<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
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

        // Pforile belongs to user so lets create user with profile
        $this->user = factory(User::class)->create();
        $this->space = factory(Space::class)->create(['user_id' => $this->user->id]);
        $this->project = factory(Project::class)->create(['user_id' => $this->user->id]);
        $this->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);
    }

    /** @test */
    public function user_can_see_space()
    {
        $response = $this->get('/spaces/' . $this->space->slug);
        $response->assertStatus(200);
        $response->assertSee($this->space->name);
    }

    /** @test */
    public function user_can_see_space_create_page()
    {
        $response = $this->actingAs($this->user)->get('/projects/' . $this->project->id . '/spaces/new');
        $response->assertStatus(200);
        $response->assertDontSee('Private');
    }

    /** @test */
    public function licensed_users_can_see_private_spaces_option()
    {
        Artisan::call('license:add', [
            'license' => $this->getTestingLicense()
        ]);
        $response = $this->actingAs($this->user)->get('/projects/' . $this->project->id . '/spaces/new');
        $response->assertStatus(200);
        $response->assertSee('Private');
    }

    /** @test */
    public function user_can_create_space()
    {
        $spaceName = 'My Space';

        $response = $this->actingAs($this->user)->withSession(['_token' => 'test'])->post('/projects/' . $this->project->id . '/spaces', [
            'name' =>  $spaceName,
            '_token' => 'test'
        ]);
        $response->assertRedirect('/projects/' . $this->project->id . '/spaces');

        $space = Space::where('name', $spaceName)->first();
        $this->assertEquals($spaceName, $space->name);
    }

    /** @test */
    public function user_can_not_create_private_space()
    {
        $spaceName = 'My Private Space';

        $response = $this->actingAs($this->user)->withSession(['_token' => 'test'])->post('/projects/' . $this->project->id . '/spaces', [
            'name' =>  $spaceName,
            'private' => true,
            '_token' => 'test'
        ]);
        $response->assertStatus(403);
        $response->assertSee('License required');
    }

    /** @test */
    public function licensed_user_can_create_private_space()
    {
        Artisan::call('license:add', [
            'license' => $this->getTestingLicense()
        ]);

        $spaceName = 'My Private Space';

        $response = $this->actingAs($this->user)->withSession(['_token' => 'test'])->post('/projects/' . $this->project->id . '/spaces', [
            'name' =>  $spaceName,
            'private' => true,
            '_token' => 'test'
        ]);
        $response->assertRedirect('/projects/' . $this->project->id . '/spaces');
    }

    /** @test */
    public function user_can_list_spaces_by_projects()
    {
        $response = $this->actingAs($this->user)->get('/projects/' . $this->project->id . '/spaces');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_see_photogallery()
    {
        $response = $this->get('/spaces/photos/' . $this->space->slug);
        $response->assertStatus(200);
        $response->assertSee($this->space->name);
    }
}
