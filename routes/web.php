<?php

Route::get('/', 'PagesController@showHomePage')->name('home');
Route::get('/attendees', 'PagesController@showAllAttendeesPage')->name('attendees.index');
Route::get('/schedules', 'ScheduleController@showAllSchedulePage')->name('schedules.index');

Route::get('/news/{post}', 'Resource\NewsController@show')->name('news.show');
Route::get('/gallery/{gallery}', 'Resource\GalleryController@show')->name('gallery.show');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('auth.loginform');
Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::get('/profile', 'PagesController@showProfilePage');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::get('/', function () {
        return redirectBasedOnUserRole(current_user());
    });

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
});

Route::post('/dashboard/editor/news/upload', 'Resource\NewsController@uploadPicture')->name('news.upload');
