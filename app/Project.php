<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\Workhorse;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'user_id', 'slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo // $project->user->name
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issues() : HasMany
    {
        return $this->hasMany(Issue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups() : BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function milestones() : HasMany
    {
        return $this->hasMany(Milestone::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spaces() : HasMany
    {
        return $this->hasMany(Space::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mergeRequests() : HasMany
    {
        return $this->hasMany(MergeRequest::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages() : HasMany
    {
        return $this->hasMany(Page::class);
    }

    /**
     * @param Page $page
     * @return false|Model
     */
    public function createPage(Page $page) : ?Model
    {
        return $this->pages()->save($page);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePrivate($query)
    {
        return $query->where('private', 1);
    }

    // for example App\Project::public()->get() or App\Project::public()->where('namespace_id',1)->get()

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublic($query)
    {
        return $query->where('private', 0);
    }

    /**
     *
     */
    public function createOnServer() : void
    {
        $user = User::find($this->user_id);
        try {
            $unicorn = new Workhorse();
            $response = $unicorn
                ->setAction('git:init:bare')
                ->setData([
                    'hooks' => Repo::hooks(),
                    'path' => Repo::path($user->username, $this->slug)
                ])->run();
        } catch (\Exception $e) {
            dd($e);
            $response = null;
            report($e);
        }

        if (null != $response && (json_decode($response))->code == 200) {
            $this->created = true;
            $this->save();
        }
    }

    /**
     * @param Space $space
     * @return false|Model
     */
    public function createSpace(Space $space) : ?Model
    {
        return $this->spaces()->save($space);
    }
}
