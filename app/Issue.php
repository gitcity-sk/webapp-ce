<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'project_id'];

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

    public function addComment(Comment $comment)
    {
        return $this->comments()->save($comment);
    }
}
