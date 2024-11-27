<?php

use App\Livewire\ApplicantDashboard;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'role:4,0'
])->group(function () {

    Route::get('/view-applicants', fn() => view('pages.view-applicants'))->name('view-applicants');
    Route::get('/edit', fn() => view('pages.company-edit-info-page'))->name('edit');
    Route::get('/manage-job-list', fn() => view('pages.manage-job-list-page'))->name('manage-job-list');
    Route::get('/applicant-dashboard', fn() => view('pages.view-applicant-dashboard'))->name('applicant-dashboard');
    Route::get('/upload-files', fn() => view('pages.company-user-file-upload'))->name('uplaod-files');
});
