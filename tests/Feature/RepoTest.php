<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repo;

class RepoTest extends TestCase
{
    /** @test */
    public function project_has_path_on_disk()
    {
        $namespace = 'project-namespace';
        $name = 'project-name';
        $expectedPath = env('GIT_DATA') . $namespace . DIRECTORY_SEPARATOR . $name . '.git';

        $this->assertEquals($expectedPath, Repo::path($namespace, $name));
    }
}
