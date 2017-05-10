<?php

namespace Atom26\Accounts;

use Atom26\Accounts\Department;
use Atom26\Accounts\University;
use Atom26\Accounts\User;
use Atom26\Accounts\UserType;
use Illuminate\Database\Eloquent\Model;

/**
 * Atom26\Accounts\UserInfo
 *
 * @property-read \Atom26\Accounts\User $user
 * @property-read \Atom26\Accounts\Department $department
 * @mixin \Eloquent
 */
class UserInfo extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['department', 'university', 'type'];

    /**
     * Get the user that belongs to bio
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user's department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return mixed
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    /**
     * @return mixed
     */
    public function type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

}
