<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesTest extends TestCase
{
    /** @test */
    public function user_can_see_all_pages()
    {
        $response = $this->get('/pages');
        $response->assertStatus(200);
    }
}
