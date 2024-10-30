<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\OjtRequirement;
use App\Models\OjtStudent;

class CheckStudentReqs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the current authenticated user
        $user = Auth::user();

        // Get the user's student equivalent
        $student = OjtStudent::where('user_id', $user->id)->first();

        // Fetch the user's req_ids from the ojt_requirements table
        $userReqIds = OjtRequirement::where('student_id', $student->id)
            ->whereNotNull('locked_at')
            ->pluck('req_id')
            ->toArray();

        // Define required req_ids from 1 to 10
        $requiredReqIds = range(1, 10);

        // Check if user has all required req_ids
        $hasAllRequirements = count(array_intersect($requiredReqIds, $userReqIds)) === count($requiredReqIds);

        // Redirect to the requirements page if the user does not have all required req_ids
        if (!$hasAllRequirements) {
            return redirect()->route('intern-requirements')->with('error', 'You cannot access the accomplishment page until all pre-ojt requirements are submitted.');
        }

        return $next($request);
    }
}
