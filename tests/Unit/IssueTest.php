<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Issue;
use App\User;
use App\Project;

class IssueTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function issue_belongs_to_user_and_project()
    {
        $issue = factory(Issue::class)->create();

        $this->assertInstanceOf(User::class, $issue->user);
        $this->assertInstanceOf(Project::class, $issue->project);
    }
}
