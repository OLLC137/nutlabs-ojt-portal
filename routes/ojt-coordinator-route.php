<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth', 'role:3,0'
])->group(function () {
    Route::get('/add-company-page', fn () => view('pages.add-company-page'))->name('add-company-page');
    Route::get('/view-company-page', fn () => view('pages.view-company-page'))->name('view-company-page');
    Route::get('/managejobs', fn () => view('pages.ojt-coordinator.manage-job-page'))->name('managejobs');
    Route::get('/company-file-upload', fn () => view('pages.company-files-upload'))->name('company-file-upload');
    Route::get('/manage-student-files', fn () => view('pages.manage-student-files-page'))->name('manage-student-files');
    Route::get('/manage-journal-requests', fn () => view('pages.manage-journal-requests-page'))->name('manage-journal-requests');
});
