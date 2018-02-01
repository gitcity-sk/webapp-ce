<?php

namespace App\Api\Git;

class GitResource
{
    public function __construct($request)
    {
        $this->request = $request;
    }
}