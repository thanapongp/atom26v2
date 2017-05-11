<?php

namespace Atom26\Http\Controllers\Dashboard;

use Atom26\Accounts\User;
use Atom26\Repositories\UserRepository;
use Illuminate\Http\Request;
use Atom26\Http\Controllers\Controller;

class HostessDashboardController extends Controller
{
    /**
     * @var \Atom26\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * Create new instance of HostessDashboardController.
     *
     * @param \Atom26\Repositories\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('role:hostess,unihostess');
        $this->userRepository = $userRepository;
    }

    public function showHostessDashboard()
    {
        $attendees = $this->userRepository->getUsersByUniversityID(
            current_user()->university()->id
        );

        return view('dashboard.hostess', compact('attendees'));
    }

    public function showAllAthletes()
    {
        $attendees = $this->userRepository->getUsersByUniversityID(
            current_user()->university()->id
        )->filter(function ($user) {
            return $user->isAthlete();
        });

        return view('dashboard.hostessathlete', compact('attendees'));
    }

    public function showAttendeeInfo(User $user)
    {
        return view('dashboard.userinfo', compact('user'));
    }
}
