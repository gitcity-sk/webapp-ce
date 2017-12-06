<?php

namespace App\Repositories;

use App\AuthorizedKey;

class AuthorizedKeys
{
    public function byUser($userID)
    {
        return AuthorizedKey::all()->where('user_id', $userID);
    }
}
