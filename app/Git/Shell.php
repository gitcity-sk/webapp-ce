<?php

namespace App\Git;

class Shell
{
    public static function isAllowed($secretKey)
    {
        if (null == $secretKey) return false;

        if ($secretKey != config('webapp.shell_secret')) return false;

        return true;
    }
}