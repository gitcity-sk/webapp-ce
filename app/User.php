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
        $project = $this->projects()->save($project);

        try {
            $unicorn = new Workhorse('tcp://127.0.0.1:88001');
            $response = $unicorn
                ->setAction('git:init:bare')
                ->setData([
                    'hooks' => Repo::hooks(),
                    'path' => Repo::path($this->name, $project['slug'])
                ])->run();
        } catch (\Exception $e) {
            $response = null;
        }

        if (null != $response && (json_decode($response))->code == 200) {
            $project['created'] = true;
            $this->projects()->save($project);
        }
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
