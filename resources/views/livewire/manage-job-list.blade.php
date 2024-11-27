<div>
    @if (session('status'))
        <div id="flash-message" class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if ($this->addJobList || $this->editJobList)
    <button wire:click="goBackAdd()" class="btn btn-primary btn-icon-text btn-small">
        <x-template.icon class="btn-icon-prepend">subdirectory-arrow-left</x-template.icon>
    back
    </button>

    <div class="card my-4 py-2 px-2">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-6 p-4 border">
                    <h1>{{ $jobInfo->job_list }}</h1>
                    <div class="form-group mb-0">
                        <h4 class="bg-primary text-white p-1 rounded">{{ $selectedCategoryName }}</h4>

                    <p class="display-5 font-weight-bold mb-0">{{ $selectedCompanyName }}</p>
                    <p class="">
                        <x-template.icon>map-marker-outline</x-template.icon>
                        {{ $jobInfo->co_address }}
                    </p>
                    <div class="mb-4">
                        {!! $jobInfo->job_desc !!}
                    </div>
                    </div>

                    <div class="form-group mb-0">
                        <p class="font-weight-bold">Recommended Programs</p>
                    </div>

                    <div class="form-group mb-0">
                        <p class="font-weight-bold">Provided Files</p>
                        <div class="d-block">
                            <button class="btn btn-sm btn-info rounded">Requirement.pdf<x-template.icon>download</x-template.icon></button>
                            <button class="btn btn-sm btn-info rounded">Requirement.pdf<x-template.icon>download</x-template.icon></button>
                        </div>
                    </div>
                </div>



                <!--Right Side-->
                <div class="col-lg-6 d-flex flex-column justify-content-between">
                    <div>
                        <h2>Resumé</h2>
                        <div class="form-check mx-4 my-0">
                            <input class="form-check-input" type="radio" wire:model="resumeSelect"
                                value="useResume" id="useResume">
                            <label class="form-check-label" for="useResume">
                                Use resumé from requirements
                            </label>
                        </div>
                        <div class="form-check mx-4 my-0">
                            <input class="form-check-input" type="radio" wire:model="resumeSelect"
                                value="uploadResume" id="uploadResume">
                            <label class="form-check-label" for="uploadResume">
                                Upload new resumé
                            </label>
                        </div>
                        <div class="form-check mx-4 my-0">
                            <input class="form-check-input" type="radio" wire:model="resumeSelect"
                                value="noResume" id="noResume">
                            <label class="form-check-label" for="noResume">
                                Do not include a resumé
                            </label>
                        </div>

                        <h2>Cover Letter</h2>
                        <div class="form-check mx-4 my-0">
                            <input class="form-check-input" type="radio" wire:model="coverSelect"
                                value="uploadCover" id="uploadCover">
                            <label class="form-check-label" for="uploadCover">
                                Upload Cover Letter
                            </label>
                        </div>
                        <div class="form-check mx-4 my-0">
                            <input class="form-check-input" type="radio" wire:model="coverSelect"
                                value="writeCover" id="writeCover">
                            <label class="form-check-label" for="writeCover">
                                Write a Cover
                            </label>
                        </div>
                        <div class="form-check mx-4 my-0">
                            <input class="form-check-input" type="radio" wire:model="coverSelect"
                                value="noCover" id="noCover">
                            <label class="form-check-label" for="noCover">
                                Do not include a cover letter
                            </label>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @elseif (!$this->company)
    <h1>Manage Job Listings</h1>
    <div class="col-md-4 grid-margin">
        <div class="input-group">
            <input type="text" class="form-control" wire:model="searchBar" wire:keydown.enter="doSearch" placeholder="Search here...">
            <div class="input-group-append">
            @if ($this->search != '')
            <x-template.icon wire:click="$set('search', ''); $set('searchBar', '')" style="margin: 0 0 0 -1.6em; cursor: pointer;" class="text-danger">close</x-template.icon>
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

        @if($this->byCompany)
        <div class="card my-2">
            <div class="card-body">
                <h2 class="card-title">Select a company to edit its job lists</h2>
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
                <table class="table table-hover" role="button">
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
                        <tr wire:click="selectJob({{ $job->id }})">
                            <td>{{ $job->job_ref }}</td>
                            <td>{{ $job->co_name }}</td>
                            <td>{{ $job->job_list }}</td>
                            <td>{{ $job->job_category }}</td>
                            <td>{{ $job->job_person }}</td>
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
            <x-template.button  variant="inverse" :rounded="true" color="primary" wire:click="goToJobList">
                Add a Job List <i class="btn-icon-append"><x-template.icon>plus</x-template.icon></i>
            </x-template.button>
        </div>

        <p class="h1 my-4">Job Listings of {{ $companyName }}</p>

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
                <tr  wire:click="selectJob({{ $job->id }})" role="button">
                    <td>{{ $job->job_ref }}</td>
                    <td>{{ $job->job_list }}</td>
                    <td>{{ $job->job_category }}</td>
                    <td>{{ $job->job_person }}</td>
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
        {{ $jobListings->links() }}
    @endif
</div>

@assets
<style>
.dropdown-box {
    background-color: white;
    position: absolute;
    display: block;
    z-index: 50;
    box-shadow: 0 4px 7px -1px #9f9f9f;
}

.dropdown-box-hide {
    display: none;
}

.dropdown-options {
    max-height: 200px;
    overflow-y: auto;
}

.dropdown-option {
    background: white;
    height: 50px;
}

.dropdown-option:hover {
    background: rgb(211, 211, 211);
}
</style>
@endassets
