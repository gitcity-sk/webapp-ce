<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Page;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PagesApiTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function api_can_get_pages_by_project()
    {
        $page = factory(Page::class)->create();

        $response = $this->get('/api/pages/' . $page->project->id);
        $response->assertStatus(200);
    }
}
