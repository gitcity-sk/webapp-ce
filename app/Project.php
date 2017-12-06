<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'user_id', 'slug'];

    public function user() // $project->user->name
    {
        return $this->belongsTo(User::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    public function scopePrivate($query)
    {
        return $query->where('private', 1);
    }

    // for example App\Project::public()->get() or App\Project::public()->where('namespace_id',1)->get()
    public function scopePublic($query)
    {
        return $query->where('private', 0);
    }
}
