<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\OjtStudent;


class CheckStudentId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if the user has a CV profile in the ojt_students table
        $isCvComplete = OjtStudent::where('user_id', $user->id)->exists();

        if (!$isCvComplete) {
            // Redirect to CV profile page and show an error message
            return redirect()->route('view-cv-page')->with('error', 'Please complete your CV profile first.');
        }


        return $next($request);
    }
}
