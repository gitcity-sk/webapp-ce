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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function labels()
    {
        return $this->belongsToMany(Label::class)->withTimestamps();
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
     * @param Label $label
     * @return Model
     */
    public function addLabel($labelId)
    {
        return $this->labels()->attach($labelId);
    }

    /**
     * @param Label $label
     * @return Model
     */
    public function removeLabel($labelId)
    {
        return $this->labels()->attach($labelId);
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
