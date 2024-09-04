<?php

use Illuminate\Support\Facades\Route;

// // Middleware to ensure authentication and super admin role
// Route::middleware(['auth', 'role:0'])->group(function () {

//     // Define routes accessible to super admin

//     // Access to admin routes
//     Route::prefix('admin')->group(function () {
//         Route::get('/template-dashboard', fn () => view('pages.dashboard'))->name('template-dashboard');
//         Route::get('/icons', fn () => view('pages.icons'))->name('icons');
//         Route::get('/forms', fn () => view('pages.forms'))->name('forms');
//         Route::get('/charts', fn () => view('pages.charts'))->name('charts');
//         Route::get('/basic-tables', fn () => view('pages.tables'))->name('tables');
//         Route::get('/manage-users', fn () => view('pages.manage-users'))->name('manage-users');
//         Route::get('/typography', fn () => view('pages.basic-ui.typography'))->name('typography');
//         Route::get('/buttons', fn () => view('pages.basic-ui.buttons'))->name('buttons');
//     });

//     // Access to student routes
//     Route::prefix('student')->group(function () {
//         Route::get('/get-started', fn () => view('pages.landing-page'))->name('landing-page');
//         Route::get('/cv-profile-page', fn () => view('pages.cv-profile-page'))->name('cv-profile-page');
//         Route::get('/edit-cv-page', fn () => view('pages.edit-cv-page'))->name('edit-cv-page');
//         Route::get('/intern-requirements', fn () => view('pages.intern-requirements-page'))->name('intern-requirements');
//         Route::get('/buttons', fn () => view('pages.basic-ui.buttons'))->name('basic-ui.buttons');
//         Route::get('/posting', fn () => view('pages.journal.journal-post'))->name('journal.journal-post');
//         Route::get('/viewing', fn () => view('pages.journal.journal-view'))->name('journal.journal-view');
//     });

//     // Access to ojt coordinator routes
//     Route::prefix('ojt-coordinator')->group(function () {
//         Route::get('/typography', fn () => view('pages.basic-ui.typography'))->name('typography');
//         Route::get('/buttons', fn () => view('pages.basic-ui.buttons'))->name('buttons');
//         // Define routes specific to ojt coordinator
//     });

//     // Access to ojt head routes
//     Route::prefix('ojt-head')->group(function () {
//         Route::get('/ojt-head-dashboard', fn () => view('pages.ojt-head.dashboard'))->name('ojt-head-dashboard');
//         Route::get('/view-cv-page', fn () => view('pages.view-cv-page'))->name('view-cv-page');
//         Route::get('/delete-cv-page', fn () => view('pages.delete-cv-page'))->name('delete-cv-page');
//     });

// });

