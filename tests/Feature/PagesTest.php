<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPrivacyPage()
    {
        $response = $this->get('/privacy');
        $response->assertStatus(200);
        $response->assertSee('<div class="card-header">Privacy policy</div>');
    }

    public function testTermsPage()
    {
        $response = $this->get('/terms');
        $response->assertSee('<div class="card-header">Terms of Service</div>');
    }

    public function testPricingPage()
    {
        $response = $this->get('/license');
        $response->assertSee('<h1 class="card-title pricing-card-title"><i class="fas fa-euro-sign"></i>27 <small class="text-muted">per year</small></h1>');
    }
}
