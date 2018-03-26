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
    public function user_can_see_create_page()
    {
        $response = $this->actingAs($this->project->user)->get('/-/cms/' . $this->project->id . '/pages/new');
        $response->assertStatus(200);
        $response->assertSee('New Page');
    }

    /** @test */
    public function user_can_create_page()
    {
        $data = [
            'title' => 'TEST',
            'slug' => str_slug('TEST'),
            'description' => 'Description',
            'project_id' => $this->project->id,
            'user_id' => $this->project->user->id
        ];
        $response = $this->actingAs($this->project->user)->post('/-/cms/' . $this->project->id . '/pages', $data);
        //$response->assertStatus(302);
        // $createdPage = Page::where('title', $data['title'])->where('description', 'LIKE' ,$data['description'])->firstOrFail();
        // $this->assertEquals($data['title'], $createdPage->title);
        // $this->assertEquals($data['description'], $createdPage->description);
        // dd($createdPage);
    }

    /** @test */
    public function user_can_edit_page()
    {
        $page = factory(Page::class)->create(['project_id' => $this->project->id]);

        $response = $this->actingAs($this->project->user)->get('/-/cms/pages/' . $page->id . '/edit');
        $response->assertStatus(200);
    }
}
