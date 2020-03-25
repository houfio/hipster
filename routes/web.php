<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/semester/{semester}', 'HomeController@index');

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('/assessments/{file}', 'FileController@downloadAssessment');
Route::post('/attach/{teacher}/{subject}/{to}', 'AttachController@toggle');

Route::resource('teachers', 'TeacherController')->except(['show']);
Route::resource('subjects', 'SubjectController')->except(['show']);
Route::resource('exams', 'ExamController')->except(['show']);
Route::resource('deadlines', 'DeadlineController')->except(['show']);
Route::resource('tags', 'TagController')->only(['index', 'store', 'destroy']);
