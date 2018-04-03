<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\RolesTrait;
use App\Services\Workhorse;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, RolesTrait, HasApiTokens;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects() : HasMany //$user->project->name
    {
        return $this->hasMany(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups() : HasMany
    {
        return $this->hasMany(Group::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile() : HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authorizedKeys() : HasMany
    {
        return $this->hasMany(AuthorizedKey::class);
    }

    /**
     * @param Project $project
     * @return Project|false|Model
     */
    public function publish(Project $project) : ?Project
    {
        $project['slug'] = str_slug($project['name']);
        $project = $this->projects()->save($project);

        try {
            $unicorn = new Workhorse();
            $response = $unicorn
                ->setAction('git:init:bare')
                ->setData([
                    'hooks' => Repo::hooks(),
                    'path' => Repo::path($this->name, $project['slug'])
                ])->run();
        } catch (\Exception $e) {
            $response = null;
            report($e);
        }

        if (null != $response && (json_decode($response))->code == 200) {
            $project['created'] = true;
            $this->projects()->save($project);
        }

        return $project;
    }

    /**
     * @param Group $group
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function publishGroup(Group $group) : Model
    {
        return $this->groups()->save($group);
    }

    /**
     * @param AuthorizedKey $authorizedKey
     */
    public function addKey(AuthorizedKey $authorizedKey) : void
    {
        $this->authorizedKeys()->save($authorizedKey);

        try {
            $unicorn = new Workhorse();
            $response = $unicorn
                ->setAction('security:write:keys')
                ->setData([
                    'path' => env('GIT_SSH_KEYS'),
                    'ssh_exec' => env('GITCITY_SSH_EXEC'),
                    'keys' => AuthorizedKey::select(['id', 'public_key'])->get()->toArray()
                ])->run();
        } catch (\Exception $e) {
            $response = null;
            report($e);
        }
    }

    /**
     * @param AuthorizedKey $authorizedKey
     * @throws \Exception
     */
    public function removeKey(AuthorizedKey $authorizedKey) : void
    {
        $authorizedKey->delete();

        try {
            $unicorn = new Workhorse();
            $response = $unicorn
                ->setAction('security:write:keys')
                ->setData([
                    'path' => env('GIT_SSH_KEYS'),
                    'keys' => AuthorizedKey::select(['id', 'public_key'])->get()->toArray()
                ])->run();
        } catch (\Exception $e) {
            $response = null;
            report($e);
        }
    }
}
