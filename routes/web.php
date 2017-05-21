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

Route::get('/attendees', 'PagesController@showAllAttendeesPage')->name('attendees.index');
Route::get('/schedules', 'ScheduleController@showAllSchedulePage')->name('schedules.index');

Route::get('/news', 'Resource\NewsController@index')->name('news.index');
Route::get('/gallery', 'Resource\GalleryController@index')->name('gallery.index');

Route::get('/news/{post}', 'Resource\NewsController@show')->name('news.show');
Route::get('/gallery/{gallery}', 'Resource\GalleryController@show')->name('gallery.show');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('auth.loginform');
Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::get('/profile', 'PagesController@showProfilePage');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::get('/', function () {
        return redirectBasedOnUserRole(current_user());
    })->name('dashboard');

    Route::get('/admin', 'Dashboard\AdminDashboardController@showAdminDashboard');

    Route::get('/editor', 'Dashboard\ITDashboardController@showEditorDashboard')->name('dashboard.editor');
    Route::get('/editor/news/new', 'Resource\NewsController@create')->name('news.create');
    Route::post('/editor/news/new', 'Resource\NewsController@store')->name('news.store');
    Route::get('/editor/news/edit/{post}', 'Resource\NewsController@edit')->name('news.edit');
    Route::post('/editor/news/edit/{post}', 'Resource\NewsController@update')->name('news.update');
    Route::post('/editor/news/delete/{post}', 'Resource\NewsController@destroy')->name('news.delete');

    Route::get('/editor/gallery/all', 'Resource\GalleryController@indexDashboard')->name('gallery.index.dashboard');
    Route::get('/editor/gallery/new', 'Resource\GalleryController@create')->name('gallery.new');
    Route::post('/editor/gallery/new', 'Resource\GalleryController@store')->name('gallery.store');

    Route::post('/editor/galler/upload', 'Resource\GalleryController@upload')->name('gallery.upload');

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
