<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'label'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions() : BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @param Permission $permission
     * @return Model
     */
    public function givePermissionTo(Permission $permission) : Model
    {
        return $this->permissions()->save($permission);
    }
}
