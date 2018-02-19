<?php

use App\Presenters\Markdown;

if (! function_exists('markdown')) {
    function markdown()
    {
        return new Markdown();
    }
}