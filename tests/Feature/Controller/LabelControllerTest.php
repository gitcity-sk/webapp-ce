<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Label;

class LabelControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $label = factory(Label::class)->create();

        $response = $this->get('/admin/labels');
        $response->assertStatus(200);
        $response->assertSee($label->title);
        $response->assertSee('Labels');
    }

    public function testCreate()
    {
        $response = $this->get('/admin/labels/create');
        $response->assertStatus(200);
        $response->assertSee('Create label');
    }
}
