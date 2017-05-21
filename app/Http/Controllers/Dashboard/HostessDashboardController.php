<?php

namespace Atom26\Http\Controllers\Dashboard;

use Atom26\Accounts\User;
use Illuminate\Http\Request;
use Atom26\Accounts\University;
use Illuminate\Support\Facades\DB;
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

    /**
     * Show hostess main dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showHostessDashboard()
    {
        $attendees = $this->userRepository->getUsersByUniversityID(
            current_user()->university()->id
        );

        return view('dashboard.hostess', compact('attendees'));
    }

    /**
     * Show all atheletes.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showAllAthletes()
    {
        $attendees = $this->userRepository->getUsersByUniversityID(
            current_user()->university()->id
        )->filter(function ($user) {
            return $user->isAthlete();
        });

        return view('dashboard.hostessathlete', compact('attendees'));
    }

    /**
     * Show list of all universities.
     * 
     * @return \Illuminate\Http\Response [description]
     */
    public function showAllUniversities()
    {
        abort_unless(current_user()->hasRole('hostess'), 403);

        $universities = Cache::rememberForever('universities', function () {
            return University::where('id', '!=', 24)->get();
        });

        return view('dashboard.hostessalluni', compact('universities'));
    }

    /**
     * Show all attendees by universities.
     * 
     * @param  \Atom26\Accounts\University $university
     * @return \Illuminate\Http\Response
     */
    public function showAttendeesByUniversity(University $university)
    {
        abort_unless(current_user()->hasRole('hostess'), 403);
        
        $attendees = $this->userRepository->getUsersByUniversityID($university->id);

        return view('dashboard.hostessbyuni', compact('attendees', 'university'));
    }

    /**
     * Show attendee's info.
     * 
     * @param  \Atom26\Accounts\User   $user
     * @return \Illuminate\Http\Response
     */
    public function showAttendeeInfo(User $user)
    {
        return view('dashboard.userinfo', compact('user'));
    }

    /**
     * Approve user and generate card for the user.
     * 
     * @param  \Atom26\Accounts\User   $user
     * @return \Illuminate\Http\Response
     */
    public function approveUser(User $user)
    {
        $user->active = true;
        $user->save();

        // TODO: Refactor this ASAP
        resolve('\Atom26\Console\Commands\GenerateCards')->generateCard($user);

        Cache::forget('attendees-'.$user->university()->id);

        return redirect()->back();
    }

    /**
     * Delete user.
     * 
     * @param  \Atom26\Accounts\User   $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(User $user)
    {
        $user->delete();

        Cache::forget('attendees-'.$user->university()->id);

        return redirect('/dashboard/hostess');
    }

    /**
     * Toggle registration page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function toggleRegistrationPage()
    {
        $newStatus = register_status()->value == 0 ? 1 : 0;

        DB::table('config')
            ->where('name', 'register_open')
            ->update(['value' => $newStatus]);

        return redirect()->back();
    }
}
