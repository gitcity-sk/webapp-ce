<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Page;
use App\Project;
use App\User;

class PageTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->page = factory(Page::class)->create();
        
    }

    /** @test */
    public function page_have_author()
    {
        $this->assertInstanceOf(User::class, $this->page->author);
    }

    /** @test */
    public function page_belongs_to_project()
    {
        $this->assertInstanceOf(Project::class, $this->page->project);
    }
}
