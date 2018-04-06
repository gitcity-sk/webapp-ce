<?php

namespace App\Git;

class Shell
{
    /**
     * Return if shell secret is allowed to get information trough API
     *
     * @param $secretKey
     * @return bool
     */
    public static function isAllowed($secretKey) : bool
    {
        if (null == $secretKey) {
            return false;
        }

        if ($secretKey != config('webapp.shell_secret')) {
            return false;
        }

        return true;
    }
}
