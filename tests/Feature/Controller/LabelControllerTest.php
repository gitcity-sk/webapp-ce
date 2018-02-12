<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Label;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LabelControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function administrators_can_see_all_labels()
    {
        $label = factory(Label::class)->create();

        $response = $this->get('/admin/labels');
        $response->assertStatus(200);
        $response->assertSee($label->title);
        $response->assertSee('Labels');
    }

    /** @test */
    public function administrators_can_see_labels_create_form()
    {
        $response = $this->get('/admin/labels/create');
        $response->assertStatus(200);
        $response->assertSee('Create label');
    }
}
