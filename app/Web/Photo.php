<?php

namespace Atom26\Web;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function has_photos()
    {
        return $this->morphTo();
    }
}
