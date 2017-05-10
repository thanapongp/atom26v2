<?php

namespace Atom26\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Show all schedules page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllSchedulePage()
    {
        return view('pages.schedule.allschedules');
    }
}
