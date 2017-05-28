<?php

namespace Atom26\Http\Controllers\Resource;

use Atom26\Web\Event;
use Illuminate\Http\Request;
use Atom26\Accounts\University;
use Atom26\Http\Controllers\Controller;
use Atom26\Repositories\EventRepository;

class EventController extends Controller
{
    /**
     * Instance of EventRepository.
     * 
     * @var \Atom26\Repositories\EventRepository
     */
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource in the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDashboard()
    {
        return view('dashboard.sport.index', [
            'events' => Event::all()
        ]);
    }

    /**
     * Show form for adding athletic score.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showAthleticForm()
    {
        $universities = University::all();

        return view('dashboard.sport.athletic', compact('universities'));
    }

    /**
     * Show form for adding pethong form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showPethongForm()
    {
        $universities = University::all();

        return view('dashboard.sport.pethong', compact('universities'));
    }

    /**
     * Show form for adding basketball form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showBasketballForm()
    {
        $universities = University::all();

        return view('dashboard.sport.basketball', compact('universities'));
    }

    /**
     * Show form for adding football form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showFootballForm()
    {
        $universities = University::all();

        return view('dashboard.sport.football', compact('universities'));
    }

    /**
     * Show form for adding football form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showVolleyballForm()
    {
        $universities = University::all();

        return view('dashboard.sport.volleyball', compact('universities'));
    }

    /**
     * Show form for adding football form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showTakrawForm()
    {
        $universities = University::all();

        return view('dashboard.sport.takraw', compact('universities'));
    }

    /**
     * Show form for adding football form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showESportForm()
    {
        $universities = University::all();

        return view('dashboard.sport.esport', compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->eventRepository->create($request);

        return back()->with('status', 'เพิ่มผลการแข่งขันกีฬาสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Atom26\Web\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Atom26\Web\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Atom26\Web\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Atom26\Web\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
