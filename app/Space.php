<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $fillable = ['name', 'user_id', 'project_id', 'slug'];
}
