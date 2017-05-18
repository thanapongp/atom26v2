<?php

namespace Atom26\Web;

use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
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
    protected $with = ['photos'];

    /**
     * Get all photos in this gallery
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos()
    {
        return $this->morphMany('\Atom26\Web\Photo', 'has_photos');
    }

    /**
     * Get gallery's views count.
     * 
     * @return int
     */
    public function getViewCount()
    {
        if (! Redis::get($this->redisKey())) {
            Redis::set($this->redisKey(), 0);
        }

        return number_format(Redis::get('gallery:viewcount:'.$this->id));
    }

    public function redisKey()
    {
        return 'gallery:viewcount:' . $this->id;
    }
}
