<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Label;

class LabelTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLabelCreate()
    {
        $label = factory(Label::class)->create();
        $foundLabel = Label::find($label->id);

        $this->assertDatabaseHas('labels', [
            'id' => $label->id
        ]);

        $this->assertEquals($foundLabel->title, $label->title);
    }
}
