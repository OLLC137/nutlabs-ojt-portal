<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckStudentId;
use App\Http\Middleware\CheckStudentReqs;

Route::middleware([
    'auth', 'role:2,0'
])->group(function () {
    Route::get('/ojt-head-dashboard', fn () => view('pages.ojt-head.dashboard'))->name('ojt-head-dashboard');
    Route::get('/delete-cv-page', fn () => view('pages.delete-cv-page'))->name('delete-cv-page');
});
