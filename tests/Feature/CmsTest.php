<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use App\Page;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;

class CmsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->project = factory(Project::class)->create();
        Artisan::call('license:add', [
            'license' => 'pEisgn6VgkKGA+rQIWP1ZxBEvH5DZTOdD2fBcNhRiy7gN+v9JGRjz6UHS7Rti6+qb+yq/gMJM+o1IZtd/UCPtbisa0oyN9THuUXlioCDJhPh0EUf77kaRmCi6s313HsrjK/xQLwp/dbKWAV7Sq1wvTmFFrBbRe0LHu1HV7vKVNkso65yhAVeOgr+SQaGtFdCqelNqj7N3LgY4MgfucGrPkPQcSdVCDk1GkVf3460oYF7UIs3HopeWcsBx4YRV3LnbJL5Co3+kljnwdqSrhumRTiticX3pEOte1f6ksb/6mebuA5q4Ubh3nrtkGBs0VSF5x1v7goCCa+LpJpO3PknryC8hgkJjMhsu8V6ZSpStBhl4rcgeaLJKJPuA+marhoKpOBojBi89u5KfBEafpmvD/wj389hN+lXwGosbs/HW6dSSj4pj3zThtfRkInugQEQZ+7LhtUjq7otQULNC6ifnbQD3fLHS6QquTdtyKF3Fas0WxfO1WrwGvmE7NV7TvnW4C+eDyJxPNAXLmWMdknvbJnCNI0kuE84eCJaaY1JVSloN2Cn/u01ym8rnPfEWLbW3MgBYLRxxeD2zy50brwAbiGi0zGwx/yWVyjY5wNLXe0p4Q7ovO1TgvzqTaU9UCCxqBp96ZJp/xo0Sz7USKOp7/1C5Jkv7YBk3sP61vmx/Fk='
        ]);
    }

    /** @test */
    public function user_can_see_pages_in_cms()
    {
        $response = $this->actingAs($this->project->user)->get('/-/cms/' . $this->project->id);
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_see_create_page()
    {
        $response = $this->actingAs($this->project->user)->get('/-/cms/' . $this->project->id . '/pages/new');
        $response->assertStatus(200);
        $response->assertSee('New Page');
    }

    /** @test */
    public function user_can_create_page()
    {
        $data = [
            'title' => 'TEST',
            'slug' => str_slug('TEST'),
            'description' => 'Description',
            'project_id' => $this->project->id,
            'user_id' => $this->project->user->id
        ];
        $response = $this->actingAs($this->project->user)->post('/-/cms/' . $this->project->id . '/pages', $data);
        $response->assertStatus(302);
        // $createdPage = Page::where('title', $data['title'])->where('description', 'LIKE' ,$data['description'])->firstOrFail();
        // $this->assertEquals($data['title'], $createdPage->title);
        // $this->assertEquals($data['description'], $createdPage->description);
        // dd($createdPage);
    }

    /** @test */
    public function user_can_edit_page()
    {
        $page = factory(Page::class)->create(['project_id' => $this->project->id]);

        $response = $this->actingAs($this->project->user)->get('/-/cms/pages/' . $page->id . '/edit');
        $response->assertStatus(200);
    }
}
