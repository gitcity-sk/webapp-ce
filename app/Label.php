<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = ['title', 'color', 'description'];

    public function issues()
    {
        return $this->belongsToMany(Issue::class)->withTimestamps();
    }
}
