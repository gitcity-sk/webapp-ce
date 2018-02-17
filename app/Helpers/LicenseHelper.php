<?php

use App\ee\License;

if (! function_exists('license_check')) {
    function license_check($license)
    {
        return License::check($license);
    }
}