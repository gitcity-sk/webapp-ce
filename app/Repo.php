<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GitElephant\Repository;
use GitElephant\GitBinary;

class Repo extends Model
{
    public static function open($namespace, $name)
    {
        try {
            $repository = Repository::open(env('GIT_DATA') . $namespace . DIRECTORY_SEPARATOR . $name . '.git', new GitBinary('git'));
        } catch (\Exception $e) {
            return false;
        }
        return $repository;
    }

    public static function path($namespace, $name)
    {
        return env('GIT_DATA') . $namespace . DIRECTORY_SEPARATOR . $name . '.git';
    }
}
