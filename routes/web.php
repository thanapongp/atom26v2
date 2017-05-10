<?php

Route::get('/', 'PagesController@showHomePage')->name('home');
Route::get('/attendees', 'PagesController@showAllAttendeesPage')->name('attendees.index');
Route::get('/schedules', 'ScheduleController@showAllSchedulePage')->name('schedules.index');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('auth.loginform');
Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::get('/', function () {
        return redirectBasedOnUserRole(auth()->user());
    });

    Route::get('/admin', 'Dashboard\AdminDashboardController@showAdminDashboard');

});