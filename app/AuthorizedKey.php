<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorizedKey extends Model
{
    protected $fillable = ['title', 'user_id', 'public_key'];
}
