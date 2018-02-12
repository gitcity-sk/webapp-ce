<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Group;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * @test
     */
    public function group_pelongs_to_user()
    {
        $group = factory(Group::class)->create();

        $this->assertInstanceOf(User::class, $group->user);
    }
}
