<div class="display-box">
    <div class="display-box-title">
        <p class="display-box-disp">{{ $jobListing->job_list }}</p>
        <p class="display-box-category">{{ $jobListing->job_category }}</p>
    </div>

    <div class="display-box-info">
        <p class="display-box-company">{{ $jobListing->company->name }}</p>
        <p class="display-box-loc">{{ $jobListing->location }}</p>
    </div>
    
    <div class="display-box-body">
        <p class="display-box-bodytext">
            {{ $jobListing->job_desc }}
        </p>
    </div>

    <div class="display-box-status">
        <div class="display-box-sign">
            <p class="display-box-signage">{{ $jobListing->job_status }}</p>
        </div>
        <div>
            <p class="display-box-person"><x-template.icon>account</x-template.icon>&nbsp;{{ $jobListing->job_person }}</p>
            <p class="display-box-email"><x-template.icon>email</x-template.icon>&nbsp;{{ $jobListing->job_email }}</p>
            <p class="display-box-contact"><x-template.icon>phone</x-template.icon>&nbsp;{{ $jobListing->job_contact }}</p>
        </div>
    </div>
</div>
