<?php

Route::get('/', 'PagesController@showHomePage')->name('home');
Route::get('/attendees', 'PagesController@showAllAttendeesPage')->name('attendees.index');
Route::get('/schedules', 'ScheduleController@showAllSchedulePage')->name('schedules.index');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('auth.loginform');
Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/logout', 'Auth\LoginController@logout')->name('auth.logout');

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
});

Route::post('/dashboard/editor/news/upload', 'Resource\NewsController@uploadPicture')->name('news.upload');