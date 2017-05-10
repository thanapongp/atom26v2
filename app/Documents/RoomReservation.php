<?php

namespace Atom26\Documents;

use Atom26\Accounts\User;
use Atom26\Traits\CanCheckOwner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Atom26\Documents\RoomReservation
 *
 * @property-read \Atom26\Accounts\User $user
 * @mixin \Eloquent
 */
class RoomReservation extends Model
{
    use CanCheckOwner, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id',];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date', 'delete_at'];

    /**
     * Get the user who created this meeting
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo(User::class, 'created_by');
    }
    
}
