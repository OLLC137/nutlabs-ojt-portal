<div>
    <livewire:homepage.job-list-search/>
    
    <div class="joblist-main">
        @if ($jobListings->count() == 0)
            <div class="d-flex align-items-center flex-column">
                <h1>No search results</h1>
                <p>try updating your search query</p>
            </div>

        @else
        <div class="joblist-main-card-area">
            @foreach ($jobListings as $jobList)
                @livewire('homepage.job-list-card',[
                    'jobId'=>$jobList->job_id,
                    'jobList'=>$jobList->job_list,
                    'jobCategory'=>$jobList->job_category,
                    'categoryStyle'=>  $this->getColorForCategoryId($jobList->job_category_id),
                    'companyName'=>$jobList->company_name,
                    'address'=>$jobList->location,
                    'status'=>$jobList->job_status,
                ], key($jobList->job_id))
            @endforeach
        </div>
        
        <div class="joblist-main-job-info">
            @if (!$this->id)
                <div class="joblist-select-a-job">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="joblist-arrow-icon">
                        <path d="M4.7 244.7c-6.2 6.2-6.2 16.4 0 22.6l176 176c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L54.6 272 432 272c8.8 0 16-7.2 16-16s-7.2-16-16-16L54.6 240 203.3 91.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0l-176 176z"/>
                    </svg>
                    <div class="joblist-select-a-job-job-info">
                        <h3>Select a Job</h3>
                        <p>View the details here</p>
                    </div>
                </div>
            @else
                <div class="joblist-job-info">
                    <div class="joblist-job-info-header">
                        <div class="d-flex justify-content-between">
                            <h1>{{ $jobInfo->job_list }}</h1>
                            <h2 class="joblist-job-info-category" style="{{ $this->getColorForCategoryId($jobInfo->job_category_id) }}">{{ $jobInfo->job_category }}</h2>
                        </div>
                        <h4>{{ $jobInfo->company_name }}</h4>
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                            <h6>{{ $jobInfo->location }}</h6>
                        </div>
                    </div>
                    <div class="joblist-job-info-body">
                        <p>{!! $jobInfo->job_desc !!}</p>
                        <h2 style="text-align: right">{{ $jobInfo->job_ref }}</h2>
                    </div>
                    <div class="joblist-job-info-contact">
                        <h3>Contact Information</h3>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>
                            <p>{{ $jobInfo->job_person }}</p>
                        </div>
                        <div>
                            <p class="pl-4">{{ $jobInfo->position }}</p>
                        </div>
                        <div class="d-flex  align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                            </svg>
                            <p>{{ $jobInfo->job_email }}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                            </svg>
                            <p>{{ $jobInfo->job_contact }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @endif
    </div>

    <div class="joblist-page-navbar">
        {{-- Page 1 of 20
        <div class="joblist-page-scroller btn-group">
            <button class="btn btn-icon btn-outline-secondary">
                <i class="mdi mdi-chevron-double-left"></i>
            </button>
            <button class="btn btn-sm btn-primary">1</button>
            <button class="btn btn-sm btn-outline-secondary">2</button>
            <button class="btn btn-sm btn-outline-secondary">3</button>
            <button class="btn btn-icon btn-outline-secondary">
                <i class="mdi mdi-chevron-double-right"></i>
            </button>
        </div> --}}

        {{ $jobListings->links() }}

    </div>
</div>
