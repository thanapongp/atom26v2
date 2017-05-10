<?php

namespace Atom26\Accounts;

use Illuminate\Database\Eloquent\Model;

/**
 * Atom26\Accounts\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Atom26\Accounts\User[] $users
 * @mixin \Eloquent
 */
class Role extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id',];

    /**
     * The users that belong to the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
    	return $this->belongsToMany(User::class);
    }
    
}
