<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index()
    {
        $jobListings = JobListing::all();

        return view('pages.homepage.components.display-companies', [
            'jobListings' => $jobListings
        ]);
    }
}
