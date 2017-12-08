<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;

class ProjectsTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $first = factory(Project::class)->create();

        $projects = Project::all();

        foreach ($projects as $project) {
            $this->assertInstanceOf(Project::class, $project);
        }

        $this->assertEquals([
            [
                'name' => $first->name,
                'slug' => str_slug($first->name),
                'description' => $first->description,
                'id' => $first->id,
                'user_id' => $first->user->id,
                'private' => $first->private,
                'created' => $first->created,
                'created_at' => $first->created_at,
                'updated_at' => $first->updated_at
            ]
        ], $projects->toArray());
    }

    public function testScopes()
    {
        $first = factory(Project::class)->create([
            'private' => false
        ]);
        $second = factory(Project::class)->create([
            'private' => false
        ]);

        $projects = Project::public()->get();
        $privateProjects = Project::private()->get();

        $this->assertCount(2, $projects);
        $this->assertCount(0, $privateProjects);
    }
}
