<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;

class ProjectTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUser()
    {
        $project = factory(Project::class)->create();

        $this->assertDatabaseHas('users', [
            'name' => $project->user->name
        ]);

        $this->assertDatabaseHas('projects', [
            'name' => $project->name
        ]);

        $this->assertDatabaseHas('profiles', [
            'name' => $project->user->profile->name
        ]);
    }
}
