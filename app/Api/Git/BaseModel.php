<?php

namespace App\Api\Git;

class BaseModel
{
    // default branch
    protected $branch = 'master';

    // default path for tree
    protected $path = null;

    protected function _configure($options)
    {
        foreach ($options as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
