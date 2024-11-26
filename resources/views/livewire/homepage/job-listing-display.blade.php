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
                <div class="display-box-sign">
                    <p class="display-box-signage">
                        @switch($jobList->job_status)
                            @case(1)
                                <p style="color: green; font-weight:bold;">OPEN</p>
                                @break
                            @case(0)
                                <p style="color: red; font-weight:bold;">CLOSED</p>
                                @break
                            @default
                                <!-- Handle any unexpected values here -->
                        @endswitch
                    </p>
                </div>
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

    function adjustFontSize() {
            const elements = document.getElementsByClassName('display-box-disp');
            const maxFontSize = 25; // Maximum font size in pixels (you can adjust this value)
            for (let element of elements) {
                const parentWidth = element.clientWidth;
                const parentHeight = element.clientHeight;
                let fontSize = 10; // Start with a base font size
                element.style.fontSize = `${fontSize}px`;

                while ((element.scrollWidth <= parentWidth && element.scrollHeight <= parentHeight) && fontSize < maxFontSize) {
                    fontSize += 1;
                    element.style.fontSize = `${fontSize}px`;
                }

                // If the font size exceeds the maxFontSize, reset it to maxFontSize
                if (fontSize > maxFontSize) {
                    fontSize = maxFontSize;
                } else {
                    fontSize -= 0.5; // Adjust the last increment
                }
                element.style.fontSize = `${fontSize}px`;
            }
        }

        window.addEventListener('load', adjustFontSize);
        window.addEventListener('resize', adjustFontSize);
</script>