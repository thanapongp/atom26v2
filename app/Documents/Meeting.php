<?php

namespace Atom26\Documents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Atom26\Documents\Meeting
 *
 * @property-read \Atom26\Documents\Memo $agenda
 * @property-read \Atom26\Documents\Memo $result
 * @mixin \Eloquent
 */
class Meeting extends Model
{
    use SoftDeletes;

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
    protected $dates = ['date', 'deleted_at'];

    /**
     * Get meeting's agenda
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agenda()
    {
    	return $this->belongsTo(Memo::class, 'agenda_id');
    }

    /**
     * Get meeting's result
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function result()
    {
    	return $this->belongsTo(Memo::class, 'result_id');
    }

    /**
     * Get uploadder's department name.
     * 
     * @return string
     */
    public function getDepartmentName()
    {
        return $this->agenda->getDepartmentName();
    }

    /**
     * Check if the user created this meeting
     * 
     * @return boolean
     */
    public function own()
    {
        return $this->agenda->own();
    }

    /**
     * Get all meetings own by the user
     * 
     * @return Illuminate\Support\Collection
     */
    public static function getAllOwnMeeting()
    {
        return static::all()->filter(function ($meeting) {
            return $meeting->own();
        });
    }

}
