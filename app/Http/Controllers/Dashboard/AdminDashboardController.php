<?php

namespace Atom26\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Atom26\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    /**
     * Create new instance of AdminDashboardController.
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Show admin dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdminDashboard()
    {
        return view('dashboard.admin');
    }
}
