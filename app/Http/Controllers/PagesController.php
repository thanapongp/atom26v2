<?php

namespace Atom26\Http\Controllers;

use Atom26\Web\Post;
use Atom26\Web\Gallery;
use Illuminate\Http\Request;
use Atom26\Accounts\University;
use Illuminate\Support\Facades\Cache;
use Atom26\Repositories\UserRepository;

class PagesController extends Controller
{
    /**
     * Instance of \Atom26\Repositories\UserRepository
     *
     * @var \Atom26\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * Create new instance of PagesController.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth')->only(['showProfilePage']);
        $this->userRepository = $userRepository;
    }

    /**
     * Show home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHomePage()
    {
        $news = Cache::remember('home-news', 60, function () {
            return Post::latest()->limit(3)->get();
        });

        $galleries = Cache::remember('home-gallery', 60, function () {
            return Gallery::latest()->limit(5)->get();
        });

        return view('pages.home', compact('news', 'galleries'));
    }

    /**
     * Show all attendees page.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllAttendeesPage(Request $request)
    {
        if ($attendees = $this->userRepository->getAllAttendees($request)) {
            return view('pages.attendees', compact('attendees'));
        }

        return $this->showAllUniversitiesPage();
    }

    /**
     * Show all universities page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function showAllUniversitiesPage()
    {
        $universities = Cache::rememberForever('universities', function () {
            return University::where('id', '!=', 24)->get();
        });

        return view('pages.universities', compact('universities'));
    }

    public function showProfilePage()
    {
        return view('dashboard.profile', ['user' => current_user()]);
    }
}
