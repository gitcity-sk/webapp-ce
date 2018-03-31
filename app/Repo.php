<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GitElephant\Repository;
use GitElephant\GitBinary;

class Repo extends Model
{
    /**
     * @param $namespace
     * @param $name
     * @return bool|Repository
     */
    public static function open($namespace, $name) : Repository
    {
        try {
            $repository = Repository::open(env('GIT_DATA') . $namespace . DIRECTORY_SEPARATOR . $name . '.git', new GitBinary(env('GIT_BINARY')));
        } catch (\Exception $e) {
            return false;
        }

        return $repository;
    }

    /**
     * @param $namespace
     * @param $name
     * @return string
     */
    public static function path($namespace, $name) : string
    {
        return env('GIT_DATA') . $namespace . DIRECTORY_SEPARATOR . $name . '.git';
    }

    /**
     * @return mixed
     */
    public static function hooks()
    {
        return env('GITCITY_SHELL_HOOKS');
    }
}
