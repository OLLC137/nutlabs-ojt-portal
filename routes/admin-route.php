<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth', 'role:1,0'
])->group(function () {
    Route::get('/template-dashboard', fn () => view('pages.dashboard'))->name('template-dashboard');
    Route::get('/icons', fn () => view('pages.icons'))->name('icons');
    Route::get('/forms', fn () => view('pages.forms'))->name('forms');
    Route::get('/charts', fn () => view('pages.charts'))->name('charts');
    Route::get('/basic-tables', fn () => view('pages.tables'))->name('tables');
    Route::get('/manage-users', fn () => view('pages.manage-users'))->name('manage-users');
    Route::get('/typography', fn () => view('pages.basic-ui.typography'))->name('typography');
    Route::get('/buttons', fn () => view('pages.basic-ui.buttons'))->name('buttons');
});
