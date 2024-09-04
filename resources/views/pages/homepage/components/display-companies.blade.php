<div class="display-workspace">
    <div class="display-title">
        <p class="display-head">EXPLORE</p>
        <p>Explore available job listings for your internship</p>
    </div>
    @livewire('homepage.job-listing-display')
    <div>
        <div class="display-seemore"><a href="{{ route('joblist') }}">SEE MORE</a></div>
    </div>
</div>
