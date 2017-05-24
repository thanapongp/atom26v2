<?php

namespace Atom26\Repositories;

use Atom26\Accounts\User;
use Illuminate\Http\Request;
use Atom26\Accounts\UserInfo;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
    /**
     * @var Amount of minutes in one hour.
     */
    const ONE_HOUR = 60;

    public function register(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'email' => $data['email'],
            'active' => false,
        ]);

        $info = new UserInfo([
            'title' => $data['title'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'citizen_id' => encrypt($data['citizen_id']),
            'student_id' => $data['student_id'] ?: '',
            'gender' => $data['gender'],
            'tel' => $data['tel'],
            'tel_alt' => $data['tel_alt'] ?: '',
            'user_type_id' => $data['user_type_id'],
            'university_id' => $data['university_id'],
            'department_id' => $data['department_id'],
            'pic' => resolve('\Atom26\Services\ImageService')->resize(
                'uploads/' . $data['pic']->store('temp'),
                'files/user/pic/'
            ),
        ]);

        $user->info()->save($info);

        if (isset($data['alsoathlete'])) {
            $user->sports()->attach($data['sportList']);
        }

        Cache::forget('attendees-'.$data['university_id']);
    }

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
        })->get();
    }

    /**
     * Get all athletes by University ID and Sport ID.
     * 
     * @param  $universityID
     * @param  $sportID
     * @return \Illuminate\Support\Collection
     */
    public function getAthletes($universityID, $sportID)
    {
        return User::whereHas('info.university', function ($query) use ($universityID)  {
            return $query->where('id', $universityID);
        })->whereHas('sports', function ($query) use ($sportID)  {
            return $query->where('sport_id', $sportID);
        })->get()->map(function ($user) {
            return collect(['id' => $user->id, 'name' => $user->fullname()]);
        });
    }
}
