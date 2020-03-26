<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index');
Route::get('/semesters/{semester}', 'DashboardController@index');
Route::get('/semesters/{semester}/{subject}', 'DashboardController@grades');

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('/assessments/{file}', 'FileController@downloadAssessment');
Route::post('/attach/{teacher}/{subject}/{to}', 'AttachController@toggle');
Route::post('/attach/{deadline}/{tag}', 'AttachController@toggleTag');
Route::post('/coordinator/{subject}/{teacher}', 'AttachController@toggleCoordinator');

Route::put('/deadline/check/{deadline}', 'DeadlineController@check');

Route::resource('teachers', 'TeacherController')->except(['show']);
Route::resource('subjects', 'SubjectController')->except(['show']);
Route::resource('exams', 'ExamController')->except(['show']);
Route::resource('deadlines', 'DeadlineController')->except(['show']);
Route::resource('tags', 'TagController')->only(['index', 'store', 'destroy']);
