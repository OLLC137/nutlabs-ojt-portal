<div>
    @if (session('status'))
        <div id="flash-message" class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if ($this->jobId)
        <button wire:click="$set('jobId', null)" class="btn btn-primary btn-icon-text btn-small">
            <x-template.icon class="btn-icon-prepend">subdirectory-arrow-left</x-template.icon>
            back
        </button>

        <div class="row">
            <div class="card mt-3 col-xl-6">
                <div class="card-body">
                    <div class="row">
                        <div class="p-4 border">
                            <div class="d-flex align-items-center justify-content-between">
                                <h1>{{ $jobInfo->job_list }}</h1>
                                <h4 class="bg-primary text-white p-1 rounded">{{ $jobInfo->job_category }}</h4>
                            </div>
                            <p class="display-5 font-weight-bold mb-0">{{ $jobInfo->company_name }}</p>
                            <p class="">
                                <x-template.icon>map-marker-outline</x-template.icon>
                                {{ $jobInfo->location }}
                            </p>
                            <div class="mb-4">
                                {!! $jobInfo->job_desc !!}
                            </div>
                            @if (!empty($jobPrograms) && count(array_filter($jobPrograms)) > 0)
                                <p class="font-weight-bold">Recommended Programs</p>
                                <div class="d-flex flex-row text-white flex-wrap">
                                    @foreach ($jobPrograms as $program)
                                        <p class="bg-secondary p-1 mx-1 rounded">
                                            <x-template.icon>tag-outline</x-template.icon>
                                            {{ $program }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                            <h3>Total Job Vacancy: {{ $jobInfo->job_slots }}</h3>
                            <h5>Number of Applicants: {{$totalApplicants}}</h5>
                            <h5>Number of Accepted Applicants: {{$acceptedApplicants}}
                            @if ($jobInfo->job_slots == $acceptedApplicants)
                                <span class="text-danger"> Job Listing Full</span>
                            @endif
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif (!$this->company)
        <h1>Manage Job Listings</h1>
        <div class="col-md-4 grid-margin">
            <div class="input-group">
                <input type="text" class="form-control" wire:model="searchBar" wire:keydown.enter="doSearch"
                    placeholder="Search here...">
                <div class="input-group-append">
                    @if ($this->search != '')
                        <x-template.icon wire:click="$set('search', ''); $set('searchBar', '')"
                            style="margin: 0 0 0 -1.6em; cursor: pointer;" class="text-danger">close</x-template.icon>
                    @endif
                </div>
                <x-template.button color="primary" wire:click="doSearch">
                    <i class="mdi mdi-magnify"></i>
                </x-template.button>
            </div>
        </div>

        <div class="mb-2 col-md-6 d-flex ">
            <div>
                <x-template.button variant="inverse" :rounded="true" color="primary" wire:click="setByCompany(true)">
                    By Company
                </x-template.button>
                <x-template.button variant="inverse" :rounded="true" color="primary" wire:click="setByCompany(false)">
                    All Job Lists
                </x-template.button>


            </div>
        </div>

        @if ($this->byCompany)
            <div class="card my-2">
                <div class="card-body">
                    <h2 class="card-title">Select a company to view its job lists</h2>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Contact Number</th>
                                <th>Email Address Address</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                                <tr style="cursor: pointer" wire:click="$set('company', {{ $company->id }})">
                                    <td>{{ $company->co_name }}</td>
                                    <td>{{ $company->co_contact_number }}</td>
                                    <td>{{ $company->co_email }}</td>
                                    @if ($company->co_isactive)
                                        <td><label class="badge badge-success">Active</label></td>
                                    @else
                                        <td><label class="badge badge-primary">Inactive</label></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $companies->links() }}
        @else
            <div class="card my-2">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Job Ref #</th>
                                <th>Company Name</th>
                                <th>Job List</th>
                                <th>Job Category</th>
                                <th>Job Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobListings as $job)
                                <tr role="button" wire:click="selectJob({{ $job->id }})">
                                    <td>{{ $job->job_ref }}</td>
                                    <td>{{ $job->co_name }}</td>
                                    <td>{{ $job->job_list }}</td>
                                    <td>{{ $job->job_category }}</td>
                                    @if ($job->job_status)
                                        <td><label class="badge badge-success">OPEN</label></td>
                                    @else
                                        <td><label class="badge badge-primary">CLOSED</label></td>
                                    @endif
                                    <td>
                                        <label>
                                            <x-template.icon> lead-pencil </x-template.icon>
                                        </label>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $jobListings->links() }}
        @endif
    @else
        <div class="d-flex justify-content-between">
            <button wire:click="$set('company', null)" class="btn btn-primary btn-icon-text btn-small">
                <x-template.icon class="btn-icon-prepend">subdirectory-arrow-left</x-template.icon>
                back
            </button>
        </div>

        <p class="h1 my-4">Job Listings of {{ $companyName }}</p>

        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Job Ref #</th>
                            <th>Job List</th>
                            <th>Job Category</th>
                            <th>Job Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobListings as $job)
                            <tr wire:click="selectJob({{ $job->id }})" role="button">
                                <td>{{ $job->job_ref }}</td>
                                <td>{{ $job->job_list }}</td>
                                <td>{{ $job->job_category }}</td>
                                @if ($job->job_status)
                                    <td><label class="badge badge-success">OPEN</label></td>
                                @else
                                    <td><label class="badge badge-primary">CLOSED</label></td>
                                @endif
                                <td>
                                    <label>
                                        <x-template.icon> lead-pencil </x-template.icon>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $jobListings->links() }}
    @endif
</div>
