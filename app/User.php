<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\RolesTrait;
use App\Services\Workhorse;

class User extends Authenticatable
{
    use Notifiable, RolesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects() //$user->project->name
    {
        return $this->hasMany(Project::class);
    }

    public function authorizedKeys()
    {
        return $this->hasMany(AuthorizedKey::class);
    }

    public function publish(Project $project)
    {
        $project['slug'] = str_slug($project['name']);

        $this->projects()->save($project);

        $unicorn = new Workhorse('tcp://127.0.0.1:88001');
        $response = $unicorn
            ->setAction('git:init:bare')
            ->setData([
                'path' => Repo::path($this->name, $project['slug'])
            ])->run();

    }

    public function addKey(AuthorizedKey $authorizedKey)
    {
        $this->authorizedKeys()->save($authorizedKey);

        $unicorn = new Workhorse('tcp://127.0.0.1:88001');
        $response = $unicorn
            ->setAction('security:write:keys')
            ->setData([
                'path' => env('GIT_SSH_KEYS'),
                'keys' => AuthorizedKey::select(['id', 'public_key'])->get()->toArray()
            ])->run();
    }

    public function removeKey(AuthorizedKey $authorizedKey)
    {
        $authorizedKey->delete();

        $unicorn = new Workhorse('tcp://127.0.0.1:88001');
        $response = $unicorn
            ->setAction('security:write:keys')
            ->setData([
                'path' => env('GIT_SSH_KEYS'),
                'keys' => AuthorizedKey::select(['id', 'public_key'])->get()->toArray()
            ])->run();
    }
}
