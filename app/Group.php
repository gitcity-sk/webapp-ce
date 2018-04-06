<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'user_id', 'image'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    /**
     * @param Project $project
     */
    public function attachProject(Project $project)
    {
        $this->projects()->save($project);
    }

    public function attachMilestone(Milestone $milestone)
    {
        $this->milestones()->save($milestone);
    }
}
