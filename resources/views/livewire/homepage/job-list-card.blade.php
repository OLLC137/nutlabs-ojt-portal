<div class="joblist-card" onclick="cardClick(event, {{ $jobId }})">
    <div class="joblist-card-title">
        <h4>{{ $jobList }}</h4>
        <p class="display-box-category" style="{{ $this->categoryStyle}}">
            {{ $jobCategory }}
        </p>
    </div>
    <div class="joblist-card-info">
        <p class="jobist-company-name">{{ $companyName }}</p>
        <p class="joblist-company-address">{{ $address }}</p>
    </div>
    @if(!empty($jobPrograms) && count(array_filter($jobPrograms)) > 0)
    <div class="my-2">
        @foreach ($jobPrograms as $program)
            <div><x-template.icon>tag-outline</x-template.icon>{{ $program }}</div>
        @endforeach
    </div>
    @endif
    <div class="joblist-card-status">
        @switch($status)
        @case(1)
            <p style="color: green; font-weight:bold;">OPEN</p>
            @break
        @case(0)
            <p style="color: red; font-weight:bold;">CLOSED</p>
            @break
        @default
            <p style="color: grey; font-weight:bold;">UNKNOWN</p>
        @endswitch
    </div>
</div>



<script>
    function cardClick(event, jobId) {
        if (event.ctrlKey) {
            window.open(`/joblist/job?id=${jobId}`, '_blank');
        } else if (window.innerWidth <= 700) {
            Livewire.dispatch('openMobile', [jobId]); // Emit Livewire event for mobile view
        } else {
            Livewire.dispatch('viewJob', [jobId]); // Emit Livewire event for desktop view
        }
    }


</script>
