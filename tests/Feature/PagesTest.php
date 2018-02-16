<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PagesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_see_all_pages()
    {
        $response = $this->get('/pages');
        $response->assertStatus(200);
    }

    /** @test */
    public function can_can_manage_pages()
    {
        $project = factory(Project::class)->create();

        $response = $this->actingAs($project->user)->get('/-/cms/' . $project->id);
        $response->assertStatus(200);
    }
}
