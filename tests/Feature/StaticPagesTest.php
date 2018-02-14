<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaticPagesTest extends TestCase
{
    /** @test */
    public function user_can_see_privacy_page()
    {
        $response = $this->get('/privacy');
        $response->assertStatus(200);
        $response->assertSee('<div class="card-header">Privacy policy</div>');
    }

    /** @test */
    public function user_can_see_terms_page()
    {
        $response = $this->get('/terms');
        $response->assertSee('<div class="card-header">Terms of Service</div>');
    }

    /** @test */
    public function user_can_see_pricing_page()
    {
        $response = $this->get('/license');
        $response->assertSee('<h1 class="card-title pricing-card-title"><i class="fas fa-euro-sign"></i>27 <small class="text-muted">per year</small></h1>');
    }
}
