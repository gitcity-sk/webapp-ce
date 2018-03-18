<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MergeRequest extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'user_id', 'project_id', 'branch_from', 'branch_to'];

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
}
