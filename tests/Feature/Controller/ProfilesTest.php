<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->profileOne = factory(Profile::class)->create();
        $this->profileTwo = factory(Profile::class)->create();
    }

    /** @test */
    public function owner_can_edit_profile()
    {
        $response = $this->actingAs($this->profileOne->user)
            ->get('/profiles/' . $this->profileOne->id);
        $response->assertStatus(200);

        // can edit own profile
        $response->assertSee('Edit</a>');
    }

    /** @test */
    public function others_can_see_but_cant_edit_profile()
    {
        $response = $this->actingAs($this->profileTwo->user)
            ->get('/profiles/' . $this->profileOne->id);
        $response->assertStatus(200);

        // cant edit profile that is not owned
        $response->assertDontSee('Edit</a>');
    }
}
