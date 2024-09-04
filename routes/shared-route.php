<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckStudentId;
use App\Http\Middleware\CheckStudentReqs;

Route::middleware([
    'auth', 'role:0,2,20'
])->group(function () {
    Route::get('/view-cv-page', fn () => view('pages.view-cv-page'))->name('view-cv-page');
});
