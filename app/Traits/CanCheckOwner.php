<?php

namespace Atom26\Traits;

trait CanCheckOwner {

	/**
     * Check if the user created this meeting
     * 
     * @return boolean
     */
    public function own()
    {
    	return auth()->user()->id == $this->user->id;
    }

    /**
     * Get uploadder's department name.
     * 
     * @return string
     */
    public function getDepartmentName()
    {
        return $this->user->info->department->name;
    }
    
}