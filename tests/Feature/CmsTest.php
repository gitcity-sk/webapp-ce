<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use App\Page;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CmsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->project = factory(Project::class)->create();
    }

    /** @test */
    public function user_can_see_pages_in_cms()
    {
        $response = $this->actingAs($this->project->user)->get('/-/cms/' . $this->project->id);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_pages()
    {
        $response = $this->actingAs($this->project->user)->get('/-/cms/' . $this->project->id . '/pages/new');
        $response->assertStatus(200);
        $response->assertSee('New Page');
    }

    /** @test */
    public function user_can_edit_page()
    {
        $page = factory(Page::class)->create(['project_id' => $this->project->id]);

        $response = $this->actingAs($this->project->user)->get('/-/cms/pages/' . $page->id . '/edit');
        $response->assertStatus(200);
    }
}
