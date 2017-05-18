<?php

namespace Atom26\Repositories;

use Atom26\Accounts\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
    const ONE_HOUR = 60;

    /**
     * Get all attendees based on requested university.
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getAllAttendees(Request $request)
    {
        return $request->has('university') ? $this->getUsersByUniversityID($request->university) : null;
    }

    /**
     * Get all attendees based on requested university ID.
     *
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getUsersByUniversityID($id)
    {
        return Cache::remember('attendees-'.$id, self::ONE_HOUR, function () use ($id) {
            return $this->queryUserByUniversity($id);
        });
    }

    /**
     * Query user by university from database.
     *
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    private function queryUserByUniversity($id)
    {
        return User::whereHas('info', function ($query) use ($id) {
            $query->where('university_id', $id);
        })->where('active', true)->get();
    }

    /**
     * Query users by athlete ID.
     *
     * @param $sportID
     * @return mixed
     */
    public function queryUserBySportID($sportID)
    {
        return User::whereHas('sports', function ($query) use ($sportID) {
            $query->where('sport_id', $sportID);
        })->where('active', true)->get();
    }
}