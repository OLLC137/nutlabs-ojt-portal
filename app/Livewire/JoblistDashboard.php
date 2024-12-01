<?php

namespace App\Livewire;

use App\Models\OjtApplicant;
use App\Models\OjtCompany;
use App\Models\OjtJobListing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class JoblistDashboard extends Component
{
    public function render()
    {
        $userId = Auth::id();
        $companyId = OjtCompany::where('user_id', $userId)->first()->id;
        $jobList = OjtJobListing::where('company_id', $companyId);

        $availableCount = DB::table('ojt_job_listings')
            ->where('ojt_job_listings.company_id', $companyId)
            ->where('ojt_job_listings.job_status', true)
            ->leftJoin('ojt_applicants', 'ojt_job_listings.id', '=', 'ojt_applicants.joblist_id')
            ->selectRaw('ojt_job_listings.id, COUNT(CASE WHEN ojt_applicants.status = 1 THEN 1 END) as accepted_applicants_count, ojt_job_listings.job_slots')
            ->groupBy('ojt_job_listings.id', 'ojt_job_listings.job_slots')
            ->havingRaw('COUNT(CASE WHEN ojt_applicants.status = 1 THEN 1 END) < ojt_job_listings.job_slots')
            ->count();

        $jobs = OjtJobListing::where('company_id', $companyId)
            ->join('ojt_job_list_categories', 'ojt_job_listings.job_category', '=', 'ojt_job_list_categories.id')
            ->select('ojt_job_list_categories.cat_name as job_category', DB::raw('COUNT(*) as jobs_count'))
            ->groupBy('ojt_job_list_categories.cat_name', 'job_status')
            ->get();

        $jobListData = $jobs->map(function ($item) {
            return [
                'category' => $item->job_category,
                'jobs_count' => $item->jobs_count
            ];
        })->toArray();

        return view(
            'livewire.joblist-dashboard',
            [
                'joblistCount' => $jobList->count(),
                'availableJobListCount' => $availableCount,
                'jobListData' => $jobListData
            ]
        );
    }
}
