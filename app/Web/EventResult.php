<?php

namespace Atom26\Web;

use Atom26\Accounts\User;
use Illuminate\Database\Eloquent\Model;

class EventResult extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the athlete from this result.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function athlete()
    {
        return $this->belongsTo(User::class, 'athlete_id');
    }

    /**
     * Get the result from this event
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sets()
    {
        return $this->hasMany(EventSet::class);
    }
}
