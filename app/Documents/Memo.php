<?php

namespace Atom26\Documents;

use Atom26\Accounts\User;
use Atom26\Traits\CanCheckOwner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Atom26\Documents\Memo
 *
 * @property-read \Atom26\Accounts\User $user
 * @mixin \Eloquent
 */
class Memo extends Model
{
    use CanCheckOwner, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the user who uploaded this file
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get all memos own by the user
     * 
     * @return Illuminate\Support\Collection
     */
    public static function getAllOwnMemo()
    {
        return static::where('type', 3)->get()->filter(function ($memo) {
            return $memo->own();
        });
    }
}
