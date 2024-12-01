<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckStudentId;
use App\Http\Middleware\CheckStudentReqs;

Route::middleware([
    'auth', 'role:20,0'
])->group(function () {

    Route::get('/get-started', fn () => view('pages.landing-page'))->name('landing-page');
    Route::get('/cv-profile-page', fn () => view('pages.cv-profile-page'))->name('cv-profile-page');
    Route::get('/edit-cv-page', fn () => view('pages.edit-cv-page'))->name('edit-cv-page');
    Route::get('/student-joblist', fn () => view('pages.student.joblist'))->name('student-joblist');
    Route::get('/student-applications', fn () => view('pages.student.applications'))->name('student-applications');
    Route::get('/student-joblist/{id}', fn ($id) => view('pages.student.joblist-job', ['id' => $id]))->name('student-joblist-job');

    Route::middleware([
        'auth', CheckStudentId::class
    ])->group(function () {
        Route::get('/intern-requirements', fn () => view('pages.intern-requirements-page'))->name('intern-requirements');
        Route::get('/posting', fn () => view('pages.journal.journal-post'))->name('journal.journal-post');
        Route::get('/viewing', fn () => view('pages.journal.journal-view'))->name('journal.journal-view');
        Route::get('/request', fn () => view('pages.journal.journal-request'))->name('journal.journal-request');
    });

    Route::middleware([
        'auth', CheckStudentReqs::class
    ])->group(function () {
        Route::get('/posting', fn () => view('pages.journal.journal-post'))->name('journal.journal-post');
        Route::get('/viewing', fn () => view('pages.journal.journal-view'))->name('journal.journal-view');
        Route::get('/request', fn () => view('pages.journal.journal-request'))->name('journal.journal-request');
    });
});
