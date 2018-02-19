<?php

use App\ee\License;

if (! function_exists('license_check')) {
    function license_check($license)
    {
        return License::check($license);
    }
}

if (! function_exists('license_expired')) {
    function license_expired()
    {
        return License::expired();
    }
}
