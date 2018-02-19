<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Label;
use App\Issue;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LabelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function label_can_many_have_issues()
    {
        $label = factory(Label::class)->create();
        $issues = factory(Issue::class)->create();

        $label->issues()->save($issues);

        foreach ($label->issues as $issue) {
            $this->assertInstanceOf(Issue::class, $issue);
        }
    }
}
