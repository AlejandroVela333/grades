<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('subjects.index');
});

Route::resource('subjects', 'SubjectController');

Route::get('subjects/{subject}/activities/create', 'GradeActivityController@create')
    ->name('grade-activities.create');
Route::post('subjects/{subject}/activities', 'GradeActivityController@store')
    ->name('grade-activities.store');
Route::get('subjects/{subject}/activities/{gradeActivity}/edit', 'GradeActivityController@edit')
    ->name('grade-activities.edit');
Route::put('subjects/{subject}/activities/{gradeActivity}', 'GradeActivityController@update')
    ->name('grade-activities.update');
Route::delete('subjects/{subject}/activities/{gradeActivity}', 'GradeActivityController@destroy')
    ->name('grade-activities.destroy');
