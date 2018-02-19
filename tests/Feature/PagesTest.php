<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
