<?php

namespace Atom26\Http\Controllers\Dashboard;

use Atom26\Accounts\User;
use Illuminate\Http\Request;
use Atom26\Accounts\University;
use Illuminate\Support\Facades\Cache;
use Atom26\Http\Controllers\Controller;
use Atom26\Repositories\UserRepository;

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

    public function showAllUniversities()
    {
        abort_unless(current_user()->hasRole('hostess'), 403);

        $universities = Cache::rememberForever('universities', function () {
            return University::where('id', '!=', 24)->get();
        });

        return view('dashboard.hostessalluni', compact('universities'));
    }

    public function showAttendeesByUniversity(University $university)
    {
        abort_unless(current_user()->hasRole('hostess'), 403);
        
        $attendees = $this->userRepository->getUsersByUniversityID($university->id);

        return view('dashboard.hostessbyuni', compact('attendees', 'university'));
    }

    public function showAttendeeInfo(User $user)
    {
        return view('dashboard.userinfo', compact('user'));
    }
}
