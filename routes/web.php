<?php

Route::get('/', 'PagesController@showHomePage')->name('home');
Route::get('/attendees', 'PagesController@showAllAttendeesPage')->name('attendees.index');
Route::get('/schedules', 'ScheduleController@showAllSchedulePage')->name('schedules.index');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('auth.loginform');
Route::post('/login', 'Auth\LoginController@login')->name('auth.login');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
});