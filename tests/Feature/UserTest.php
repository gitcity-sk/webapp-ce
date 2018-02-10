<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Role;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'id' => $user->id,
            'email' => $user->email
        ]);
    }

    public function testFindUser()
    {
        $user = factory(User::class)->create();

        $foundUser = User::find($user->id);

        $this->assertEquals($user->email, $foundUser->email);
    }

    public function testUserHasRole()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $user->assignRole($role->name);

        $this->assertDatabaseHas('role_user', [
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
        
    }
}
