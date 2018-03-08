<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Milestone;
use App\Group;
use App\Project;

class MilestoneTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->milestone = factory(Milestone::class)->create();
    }
    
    /** @test */
    public function milestone_can_belongs_to_group()
    {
        $this->assertInstanceOf(Group::class, $this->milestone->group);
    }

    /** @test */
    public function milestone_can_belongs_to_project()
    {
        $this->assertInstanceOf(Project::class, $this->milestone->project);
    }
}
