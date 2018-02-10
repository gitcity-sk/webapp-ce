<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Profile;
use App\User;

class ProfilesControllerTest extends TestCase
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
        $user->profile()->save(factory(Profile::class)->make());

        $response = $this->actingAs($user)->get('/api/profiles');
        $response->assertStatus(200);
        $response->assertSee($user->profile->name);
        $response->assertSee($user->profile->facebook);
        $response->assertSee($user->profile->twitter);
    }
}
