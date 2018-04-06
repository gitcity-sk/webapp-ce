<?php

namespace Tests\Feature\Controller;

use App\Group;
use App\Milestone;
use App\Profile;
use App\Project;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class GroupsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        // Pforile belongs to user so lets create user with profile
        $this->user = factory(User::class)->create();
        $this->profile = factory(Profile::class)->create(['user_id' => $this->user->id]);

        // Group belongs to user
        $this->group = factory(Group::class)->create(['user_id' => $this->user->id]);
    }

    /** @test */
    public function users_can_see_all_groups()
    {
        $response = $this->get('/groups');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_group_create_page()
    {
        $response = $this->get('/groups/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function users_can_see_one_groups()
    {
        $response = $this->get('/groups/' . $this->group->id);
        $response->assertStatus(200);
        $response->assertSee($this->group->name);
    }

    /** @test */
    public function users_can_add_milestone_to_group()
    {
        $milestone = factory(Milestone::class)->create();

        $respone = $this->actingAs($this->user)->withSession(['_token' => 'test'])->post('/groups/' . $this->group->id . '/milestones', [
            'milestone_id' => $milestone->id
        ]);
        // after add milestone redirect back to group
        $respone->assertRedirect('/groups/' . $this->group->id . '/milestones');
        $attachedMilestone = $this->group->milestones()->where('title', $milestone->title)->first();

        $this->assertEquals($milestone->title, $attachedMilestone->title);
    }

    /** @test */
    public function user_can_add_project_to_group()
    {
        $project = factory(Project::class)->create();

        $respone = $this->actingAs($this->user)->withSession(['_token' => 'test'])->post('/groups/' . $this->group->id . '/projects', [
            'project_id' => $project->id
        ]);
        // after add milestone redirect back to group
        $respone->assertRedirect('/groups/' . $this->group->id);
        $attachedProject = $this->group->projects()->where('name', $project->name)->first();

        $this->assertEquals($project->name, $attachedProject->name);
    }

    /** @test */
    public function user_can_create_group()
    {
        $name = 'Group test';
        $description = 'Group test description';

        $response = $this->actingAs($this->user)->withSession(['_token', 'test'])->post('/groups', [
            'name' => $name,
            'description' => $description,
            '_token' => 'test'
        ]);
        $response->assertRedirect('/groups');

        $createdGroup = Group::where('name', $name)->first();
        $this->assertEquals($name, $createdGroup->name);
        $this->assertEquals($description, $createdGroup->description);
    }
}
