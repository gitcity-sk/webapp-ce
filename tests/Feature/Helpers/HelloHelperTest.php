<?php

namespace Tests\Feature\Helpers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webapp\Http\Helpers\HelloHelper;

class HelloHelperTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHelloWorld()
    {
        $this->assertEquals('Hello World', HelloHelper::helloWorld());
    }
}
