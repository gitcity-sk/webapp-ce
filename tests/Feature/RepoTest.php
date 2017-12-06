<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repo;

class RepoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPath()
    {
        $namespace = 'project-namespace';
        $name = 'project-name';
        $expectedPath = env('GIT_DATA') . $namespace . DIRECTORY_SEPARATOR . $name . '.git';

        $this->assertEquals($expectedPath, Repo::path($namespace, $name));
    }
}
