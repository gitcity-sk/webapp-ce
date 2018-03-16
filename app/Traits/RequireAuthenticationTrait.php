<?php

namespace App\Traits;

use App\Role;

trait RequireAuthenticationTrait
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
