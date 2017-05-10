<?php

namespace Atom26\Http\Controllers\Dashboard;

use Atom26\Web\Post;
use Illuminate\Http\Request;
use Atom26\Http\Controllers\Controller;

class ITDashboardController extends Controller
{
    /**
     * Create new instance of AdminDashboardController.
     */
    public function __construct()
    {
        $this->middleware('role:editor');
    }

    /**
     * Show editor dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditorDashboard()
    {
        $news = Post::latest()->get();

        return view('dashboard.editor', compact('news'));
    }
}
