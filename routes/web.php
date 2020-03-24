<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index');
Route::post('/detach/subject/{teacher}/{subject}', 'DetachController@detachSubject');
Route::post('/detach/teacher/{subject}/{teacher}', 'DetachController@detachTeacher');

Route::resource('teachers', 'TeacherController');
Route::resource('subjects', 'SubjectController');
Route::resource('exams', 'ExamController');
Route::resource('dashboard', 'DashboardController')->only(['index']);
