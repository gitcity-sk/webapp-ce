<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description', 'twitter', 'facebook', 'verified', 'user_id', 'image'];

    public function user() // $project->user->name
    {
        return $this->belongsTo(User::class);
    }
}
