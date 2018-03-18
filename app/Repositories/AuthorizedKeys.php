<?php

namespace App\Repositories;

use App\AuthorizedKey;

class AuthorizedKeys
{
    /**
     * @param $userID
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function byUser($userID)
    {
        return AuthorizedKey::all()->where('user_id', $userID);
    }
}
