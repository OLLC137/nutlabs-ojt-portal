<div style="margin:0 0; scale: 0.85;">
    <div class="joblist-job-info">
        <div class="joblist-job-info-header">
            <div class="d-flex justify-content-between">
                <h1>{{ $jobInfo->job_list }}</h1>
                <h2 class="joblist-job-info-category"
                    style="{{ $this->getColorForCategoryId($jobInfo->job_category_id) }}; height:auto">
                    {{ $jobInfo->job_category }}</h2>
            </div>
            <h4>{{ $jobInfo->company_name }}</h4>
            <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path
                        d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                </svg>
                <h6>{{ $jobInfo->location }}</h6>
            </div>
        </div>
        <div class="joblist-job-info-body">
            <p>{!! $jobInfo->job_desc !!}</p>
        </div>
        <div class="joblist-job-info-body">
            <p>{!! $jobInfo->job_desc !!}</p>
                <p><b>Recommended Programs</b></p>
            <div style="margin-top: 20px; display: flex; flex-direction: row; flex-wrap: wrap">
                @foreach ($jobPrograms as $program)
                    <div><button style="margin-right: 4px" wire:click="searchProgram('{{ $program }}')"
                            class="joblist-job-info-program"><x-template.icon>tag-outline</x-template.icon>{{ $program }}</button>
                    </div>
                @endforeach
            </div>
                            <div style="display: flex; justify-content: space-between; margin-top: 20px">
                @if ((Auth::check() && Auth::user()->role == 20) || !Auth::check())
                    <button class="joblist-job-info-apply" wire:click="applyJob({{ $jobInfo->job_id }})">
                        <h3>APPLY NOW</h3>
                    </button>
                @else
                    <p></p>
                @endif
                <h2>{{ $jobInfo->job_ref }}</h2>
            </div>
        </div>
    </div>
</div>
