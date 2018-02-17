<?php

if (! function_exists('markdown')) {
    function markdown()
    {
        return new Parsedown();
    }
}