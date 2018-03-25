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

    protected $testingLicense = 'cATOd7B5PI3gVYEcnt5hiRupfvyA8itojDp6xuaakxfFP1jMRroc0yGwC9iw7UocbyIWqxPc26kzUJneKPUIRlU/0zXgouA9bI6dr9SC8PZqGtk/KLebC4MvAqX/vBNwqCO8jM26MjPEH+ykgngfXEIgIe2FA0oTDkKIWyG4+UnDUG7eQwq1F8EKYyIfLxND+P6BOp7Egi8O97gh9GP0HScOsWj8Cw29M+yoZPiWw3Arn0IOLb3NLC02Wl6fVy7BJ5EH7QQ4ki++M/gbHiRe2KNedt71mAJXmp0GFcTdNcOuVHaUdmulv1bwdz01kpJbnoKL1Ewh09kHANJ69KsWh7NF6ZPxWA9eMMg02/eN/tiJyutpmuxCk7qQ/X4fdxQ/J10DqEikefoZboonDEynMs+gy+ntruZ3eBn3F0HGk1At2lSDuKRdN1uFkEjRduwr7QTVzJaalz+DmYubwhP4wzFIINJ326ydlx3XdiANpmW3Tp50mJkJvhIOCUwbBtkSA91CRFpupUEhyx0p/BSQyF/wlcViTXysZyVpJuhdvIp2bMSZwOCAhozr/LZTUap3Uobgc9uSy16Mdmu7LYW/QHrhrEmtS8YVWUu5k8JnOc3pxgo9whkIKxV+o7zRXbi9F9gGhpQS7sYN+7c1uOe3m2dm4eSaEklI/12jBDzfKAY=';

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
            'license' => $this->testingLicense
        ]);
        $response = $this->actingAs($this->user)->get('/projects/' . $this->project->id . '/spaces/new');
        $response->assertStatus(200);
        $response->assertSee('Private');
    }

    /** @test */
    public function user_can_create_space()
    {
        $spaceName = 'My Space';

        $response = $this->actingAs($this->user)->post('/projects/' . $this->project->id . '/spaces', [
            'name' =>  $spaceName
        ]);
        $response->assertRedirect('/projects/' . $this->project->id . '/spaces');
    }

    /** @test */
    public function user_can_not_create_private_space()
    {
        $spaceName = 'My Private Space';

        $response = $this->actingAs($this->user)->post('/projects/' . $this->project->id . '/spaces', [
            'name' =>  $spaceName,
            'private' => true
        ]);
        $response->assertStatus(403);
        $response->assertSee('License required');
    }

    /** @test */
    public function licensed_user_can_create_private_space()
    {
        Artisan::call('license:add', [
            'license' => $this->testingLicense
        ]);

        $spaceName = 'My Private Space';

        $response = $this->actingAs($this->user)->post('/projects/' . $this->project->id . '/spaces', [
            'name' =>  $spaceName,
            'private' => true
        ]);
        $response->assertRedirect('/projects/' . $this->project->id . '/spaces');
    }

    /** @test */
    public function user_can_list_spaces_by_projects()
    {
        $response = $this->actingAs($this->user)->get('/projects/' . $this->project->id . '/spaces');
        $response->assertStatus(200);
    }
}
