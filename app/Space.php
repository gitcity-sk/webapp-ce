<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'project_id', 'slug', 'private'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
