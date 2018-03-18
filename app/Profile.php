<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'twitter', 'facebook', 'verified', 'user_id', 'image'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() // $project->user->name
    {
        return $this->belongsTo(User::class);
    }
}
