<?php

namespace Atom26\Web;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function photos()
    {
        return $this->hasMany('\Atom26\Web\Photo');
    }
}
