<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Page;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PagesApiTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->page = factory(Page::class)->create();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function api_can_get_pages_by_project()
    {
        $response = $this->actingAs($this->user)->get('/api/projects/' . $this->page->project->id . '/pages');
        $response->assertStatus(200);
    }

    /** @test */
    public function api_need_authentication()
    {
        $response = $this->get('/api/projects/' . $this->page->project->id . '/pages');
        $response->assertStatus(302);
    }
}
