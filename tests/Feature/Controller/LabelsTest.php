<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Label;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

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
    public function administrators_can_see_all_labels()
    {
        $response = $this->actingAs($this->user)->get('/admin/labels');
        $response->assertStatus(200);
        $response->assertSee($this->label->title);
        $response->assertSee('Labels');
    }

    /** @test */
    public function administrators_can_see_labels_create_form()
    {
        $response = $this->actingAs($this->user)->get('/admin/labels/create');
        $response->assertStatus(200);
        $response->assertSee('Create label');
    }
}
