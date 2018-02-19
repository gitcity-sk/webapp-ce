<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function profile_belongs_to_user()
    {
        $profile = factory(Profile::class)->create();

        $this->assertInstanceOf(User::class, $profile->user);
    }
}
