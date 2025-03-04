<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index');
Route::get('/semesters/{semester}', 'DashboardController@index');
Route::get('/semesters/{semester}/{subject}', 'DashboardController@grades');

Route::get('login', 'LoginController@showLoginForm');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');

Route::get('/assessments/{file}', 'FileController@downloadAssessment');
Route::post('/attach/{teacher}/{subject}/{to}', 'AttachController@toggleTeacher');
Route::post('/attach/{deadline}/{tag}', 'AttachController@toggleTag');
Route::post('/coordinator/{subject}/{teacher}', 'AttachController@toggleCoordinator');

Route::resource('teachers', 'TeacherController')->except(['show']);
Route::resource('subjects', 'SubjectController')->except(['show']);
Route::resource('exams', 'ExamController')->except(['show']);
Route::resource('deadlines', 'DeadlineController')->except(['show', 'destroy']);
Route::resource('tags', 'TagController')->only(['index', 'store', 'destroy']);
