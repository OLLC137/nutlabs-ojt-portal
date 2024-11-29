<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function redirectAfterLogin()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 0:
                return redirect()->route('view-cv-page');
            case 1:
                return redirect()->route('template-dashboard');
            case 2:
                return redirect()->route('ojt-head-dashboard');
            case 3:
                return redirect()->route('view-company-page');
            case 4:
                return redirect()->route('applicant-dashboard');
            case 20:
                return redirect()->route('landing-page');
         }
    }
}
