<?php

namespace App\Api\Git;

class BaseModel
{
    // default branch
    /**
     * @var string
     */
    protected $branch = 'master';

    // default path for tree
    /**
     * @var null
     */
    protected $path = null;

    /**
     * @param $options
     */
    protected function _configure($options)
    {
        foreach ($options as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
