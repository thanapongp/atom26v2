<?php

Route::get('/', 'PagesController@showHomePage')->name('home');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
Route::post('/register', 'Auth\RegisterController@register')->name('auth.registerPost');
Route::get('/register-completed', function () {
    return view('auth.register-completed');
});

Route::get('/rules', function () {
    return view('pages.rules');
})->name('rules');

Route::get('/api/athlete', 'ApiController@getAthletes');

Route::get('/attendees', 'PagesController@showAllAttendeesPage')->name('attendees.index');
Route::get('/schedules', 'ScheduleController@showAllSchedulePage')->name('schedules.index');

Route::get('/news', 'Resource\NewsController@index')->name('news.index');
Route::get('/gallery', 'Resource\GalleryController@index')->name('gallery.index');

Route::get('/news/{post}', 'Resource\NewsController@show')->name('news.show');
Route::get('/gallery/{gallery}', 'Resource\GalleryController@show')->name('gallery.show');
Route::get('/gallery/{gallery}/pics', 'Resource\GalleryController@allpics')->name('gallery.pics');

Route::get('/events', 'Resource\EventController@index')->name('events.index');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('auth.loginform');
Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/profile', 'PagesController@showProfilePage');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::get('/', function () {
        return redirectBasedOnUserRole(current_user());
    })->name('dashboard');

    Route::get('/admin', 'Dashboard\AdminDashboardController@showAdminDashboard');

    /** News routes */
    Route::get('/editor', 'Dashboard\ITDashboardController@showEditorDashboard')
        ->name('dashboard.editor');
    Route::get('/editor/news/new', 'Resource\NewsController@create')
        ->name('news.create');
    Route::post('/editor/news/new', 'Resource\NewsController@store')
        ->name('news.store');
    Route::get('/editor/news/edit/{post}', 'Resource\NewsController@edit')
        ->name('news.edit');
    Route::post('/editor/news/edit/{post}', 'Resource\NewsController@update')
        ->name('news.update');
    Route::post('/editor/news/delete/{post}', 'Resource\NewsController@destroy')
        ->name('news.delete');

    /** Gallery routes */
    Route::get('/editor/gallery/all', 'Resource\GalleryController@indexDashboard')
        ->name('gallery.index.dashboard');
    Route::get('/editor/gallery/new', 'Resource\GalleryController@create')
        ->name('gallery.new');
    Route::post('/editor/gallery/new', 'Resource\GalleryController@store')
        ->name('gallery.store');
    Route::get('/editor/gallery/edit/{gallery}', 'Resource\GalleryController@edit')
        ->name('gallery.edit');
    Route::post('/editor/gallery/edit/{gallery}', 'Resource\GalleryController@update')
        ->name('gallery.update');
    Route::post('/editor/gallery/delete/{gallery}', 'Resource\GalleryController@destroy')
        ->name('gallery.delete');
    Route::post('/editor/gallery/upload', 'Resource\GalleryController@upload')
        ->name('gallery.upload');

    /** Event routes */
    Route::get('/editor/sport/', 'Resource\EventController@indexDashboard')
        ->name('event.index.dashboard');
    Route::get('/editor/sport/add/athletic', 'Resource\EventController@showAthleticForm')
        ->name('event.create.athletic');
    Route::get('/editor/sport/add/pethong', 'Resource\EventController@showPethongForm')
        ->name('event.create.pethong');
    Route::get('/editor/sport/add/takraw', 'Resource\EventController@showTakrawForm')
        ->name('event.create.takraw');
    Route::get('/editor/sport/add/bridge', 'Resource\EventController@showBridgeForm')
        ->name('event.create.bridge');
    Route::get('/editor/sport/add/board', 'Resource\EventController@showBoardForm')
        ->name('event.create.board');
    Route::get('/editor/sport/add/basketball', 'Resource\EventController@showBasketballForm')
        ->name('event.create.basketball');
    Route::get('/editor/sport/add/football', 'Resource\EventController@showFootballForm')
        ->name('event.create.football');
    Route::get('/editor/sport/add/footsal', 'Resource\EventController@showFootsalForm')
        ->name('event.create.footsal');
    Route::get('/editor/sport/add/volleyball', 'Resource\EventController@showVolleyballForm')
        ->name('event.create.volleyball');
    Route::get('/editor/sport/add/esport', 'Resource\EventController@showESportForm')
        ->name('event.create.esport');
    Route::get('/editor/sport/add/academic', 'Resource\EventController@showAcademicForm')
        ->name('event.create.academic');

    Route::post('/editor/sport/store', 'Resource\EventController@store')
        ->name('event.store');

    /** Hostess routes */
    Route::get('/hostess', 'Dashboard\HostessDashboardController@showHostessDashboard')
        ->name('dashboard.hostess');
    Route::get('/hostess/athletes', 'Dashboard\HostessDashboardController@showAllAthletes')
        ->name('dashboard.hostess.athlete');
    Route::get('/hostess/attendee/{user}', 'Dashboard\HostessDashboardController@showAttendeeInfo')
        ->name('hostess.attendee');
    Route::get('/hostess/attendees', 'Dashboard\HostessDashboardController@showAllUniversities')
        ->name('hostess.alluni');
    Route::get('/hostess/attendees/university/{university}', 
        'Dashboard\HostessDashboardController@showAttendeesByUniversity')
        ->name('hostess.attendeesuni');
    Route::post('/hostess/attendee/{user}/approve', 'Dashboard\HostessDashboardController@approveUser')
        ->name('hostess.approveuser');
    Route::post('/hostess/attendee/{user}/delete', 'Dashboard\HostessDashboardController@deleteUser')
        ->name('hostess.deleteuser');
    Route::post('/hostess/toggleregisterpage', 'Dashboard\HostessDashboardController@toggleRegistrationPage')
        ->name('hostess.toggleregisterpage');
});

Route::post('/dashboard/editor/news/upload', 'Resource\NewsController@uploadPicture')->name('news.upload');
