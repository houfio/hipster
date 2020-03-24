<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/info/{subject}', 'HomeController@exams');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/attach/{teacher}/{subject}/{to}', 'AttachController@toggle');

Route::resource('teachers', 'TeacherController')->except(['show']);
Route::resource('subjects', 'SubjectController');
Route::resource('exams', 'ExamController');
Route::resource('deadlines', 'DeadlineController')->only(['index', 'create', 'store', 'update']);
Route::resource('tags', 'TagController')->only(['index', 'store', 'destroy']);
