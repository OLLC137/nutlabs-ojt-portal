<?php

use App\Livewire\JobListPage;
use App\Livewire\JobPreview;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CheckRole;
use App\Models\Applicant;

require_once __DIR__.'/ojt-coordinator-route.php';

require_once __DIR__.'/ojt-head-route.php';

require_once __DIR__.'/admin-route.php';

require_once __DIR__.'/student-route.php';

require_once __DIR__.'/shared-route.php';

require_once __DIR__.'/company-route.php';


Route::get('/', function () {return redirect()->route('landingpage');});
Route::get('/home', fn () => view('pages.homepage.landingpage'))->name('landingpage');
Route::get('/joblist', JobListPage::class)->name('joblist');
Route::get('/joblist/job', JobPreview::class)->name('jobpreview');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [LoginController::class, 'redirectAfterLogin'])->name('dashboard');
});

Route::post('/applicants/{applicant}/accept', function (Applicant $applicant) {
    $applicant->update(['status' => 1]); // Update the status to 1
    return response()->json(['message' => 'Applicant status updated successfully.'], 200);
})->name('applicants.accept');

Route::delete('/applicants/{applicant}', function (Applicant $applicant) {
    $applicant->delete(); // Delete the applicant
    return response()->json(['message' => 'Applicant deleted successfully.'], 200);
})->name('applicants.delete');

