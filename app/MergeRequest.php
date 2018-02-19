<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MergeRequest extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'project_id', 'branch_from', 'branch_to'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
