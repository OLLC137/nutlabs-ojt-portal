<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth', 'role:4,0'
])->group(function () {
    Route::get('/view-applicants', fn () => view('pages.view-applicants'))->name('view-applicants');
});
