<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = ['title', 'description', 'project_id', 'group_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
