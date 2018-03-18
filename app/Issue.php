<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'user_id', 'project_id', 'milestone_id', 'complete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->belongsToMany(Comment::class)->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }

    /**
     * @param Comment $comment
     * @return Model
     */
    public function addComment(Comment $comment)
    {
        return $this->comments()->save($comment);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOpen($query)
    {
        return $query->where('complete', 0);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeClosed($query)
    {
        return $query->where('complete', 1);
    }
}
