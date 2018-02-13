<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        // Pforile belongs to user so lets create user with profile
        $this->user = factory(User::class)->create();
        $this->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);
    }

    /** @test */
    public function api_can_get_user_profile()
    {
        $response = $this->actingAs($this->user)->get('/api/profiles');
        $response->assertStatus(200);
        $response->assertSee($this->profile->name);
        $response->assertSee($this->profile->facebook);
        $response->assertSee($this->profile->twitter);
    }
}
