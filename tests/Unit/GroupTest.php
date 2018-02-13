<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Group;
use App\User;
use App\Project;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function group_pelongs_to_user()
    {
        $group = factory(Group::class)->create();

        $this->assertInstanceOf(User::class, $group->user);
    }

    /** @test */
    public function group_can_have_project()
    {
        $group = factory(Group::class)->create();
        $group->attachProject(factory(Project::class)->create());

        foreach ($group->projects as $project) {
            $this->assertInstanceOf(Project::class, $project);
        }
    }
}
