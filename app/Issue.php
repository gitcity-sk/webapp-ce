<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'project_id', 'milestone_id', 'complete'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class)->withTimestamps();
    }

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }

    public function addComment(Comment $comment)
    {
        return $this->comments()->save($comment);
    }

    public function scopeOpen($query)
    {
        return $query->where('complete', 0);
    }

    public function scopeClosed($query)
    {
        return $query->where('complete', 1);
    }
}
