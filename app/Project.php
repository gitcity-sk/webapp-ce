<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\Workhorse;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'user_id', 'slug'];

    public function user() // $project->user->name
    {
        return $this->belongsTo(User::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    public function scopePrivate($query)
    {
        return $query->where('private', 1);
    }

    // for example App\Project::public()->get() or App\Project::public()->where('namespace_id',1)->get()
    public function scopePublic($query)
    {
        return $query->where('private', 0);
    }

    public function createOnServer()
    {
        $user = User::find($this->user_id);
        try {
            $unicorn = new Workhorse('tcp://unicorn:8801');
            $response = $unicorn
                ->setAction('git:init:bare')
                ->setData([
                    'hooks' => Repo::hooks(),
                    'path' => Repo::path($user->name, $this->slug)
                ])->run();
        } catch (\Exception $e) {
            $response = null;
        }

        if (null != $response && (json_decode($response))->code == 200) {
            $this->created = true;
            $this->save();
        }
    }
}
