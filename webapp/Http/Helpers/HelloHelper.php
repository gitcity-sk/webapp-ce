<?php

namespace Webapp\Http\Helpers;

class HelloHelper
{
    const HELLOWORLD = 'Hello World';

    public static function helloWorld()
    {
        return self::HELLOWORLD;
    }
}