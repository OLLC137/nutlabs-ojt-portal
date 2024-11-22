<div class="display-box-container">
    @foreach ($jobListings as $jobList)
        <div class="display-box" onclick="cardClick(event, {{ $jobList->job_id }}, {{ $jobList->job_status }})">
            <div class="display-box-title">
                <p class="display-box-disp">{{ $jobList->job_list }}</p>
                <p class="display-box-category" style="{{ $this->getColorForCategoryId($jobList->job_category_id) }}">
                    {{ $jobList->job_category }}
                </p>
            </div>

            <div class="display-box-info">
                <p class="display-box-company" >{{ $jobList->company_name }}</p>
                <p class="display-box-loc">{{ $jobList->location }}</p>
            </div>

            <div class="display-box-body">
                <p class="display-box-bodytext">
                    {{ $jobList->job_desc }}
                </p>
            </div>

            <div class="display-box-status">

                <div class="d-flex flex-column justify-center mt-3">
                    <h6>{{ $jobList->job_ref }}</h6>
                </div>
            </div>
        </div>
    @endforeach
</div>


<script>
    function cardClick(event, jobId, jobStatus) {
        console.log(jobStatus);
        if (event.ctrlKey) {
            window.open(`/joblist/job?id=${jobId}`, '_blank');
        } else if (window.innerWidth <= 700 && (jobStatus != 1)) {
            Livewire.dispatch('openMobile', [jobId]); // Emit Livewire event for mobile view
        } else if (jobStatus == 1) {
            Livewire.dispatch('viewJob', [jobId]); // Emit Livewire event for desktop view
        }

    }
</script>
