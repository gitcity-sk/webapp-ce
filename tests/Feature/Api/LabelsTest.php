<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Label;
use App\User;

class LabelsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->label = factory(Label::class)->create();
    }

    /** @test */
    public function api_can_get_all_labels()
    {
        $response = $this->actingAs($this->user)->get('/api/labels');
        $response->assertStatus(200);
    }

    /** @test */
    public function api_can_get_all_labels_list()
    {
        $response = $this->actingAs($this->user)->get('/api/labels?format=list');
        $response->assertStatus(200);
    }
}
