<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\AuthorizedKey;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_has_many_authorized_keys()
    {
        $user = factory(User::class)->create();
        $authorizedKey = factory(AuthorizedKey::class)->create(['user_id' => $user->id]);

        foreach ($user->authorizedKeys as $AK) {
            $this->assertInstanceOf(AuthorizedKey::class, $AK);
        }
    }
}
