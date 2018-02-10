<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;

class ProjectTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateProject()
    {
        $project = factory(Project::class)->create();

        $foundProject = Project::find($project->id);

        $this->assertEquals($foundProject->name, $project->name);
        $this->assertEquals($foundProject->description, $project->description);

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
