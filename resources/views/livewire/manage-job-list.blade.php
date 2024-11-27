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
            <div class="card-title">
                <h2>Add a new job list</h2>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="mb-0">Job Information</h4>
                    <div class="form-group mb-0">
                        <label for="" class="col-form-label mb-0">Job List Name</label>
                        <div class=""><input wire:model="inputJobList" type="text" class="form-control" placeholder=""></div>
                        @error('inputJobList') <span class="error">A job list name is required!</span> @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label for="" class="col-form-label mb-0">Category</label>
                        <div class="position-relative bg-white">
                            <input wire:click="toggleCategory" wire:model="selectedCategoryName" class="form-control text-muted" role="button" placeholder="Select Category" readonly></input>
                            <div class="dropdown-box w-100 px-0" style="{{ $this->categoryDisplayNone() }}">
                                <input wire:model.live='categorySearchTerm' class="form-control" type="search" placeholder="Search" aria-label="Search">
                                <ul class="dropdown-options w-100 px-0">
                                    @foreach ($categoryGroup as $item)
                                    <li wire:key="{{ $item->id }}" wire:click="selectCategoryId({{ $item->id }}, '{{ $item->name }}')" class="dropdown-option d-flex align-items-center px-2 mx-0" role="button">{{ $item->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @error('selectedCategoryId') <span class="error">A category is required!</span> @enderror
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="" class="col-form-label mb-0">Description</label>
                        <x-input.rich-text wire:model.debounce="inputDescription" :initial-value="$inputDescription"></x-input.rich-text>
                    </div>
                    @error('inputDescription') <span class="error">A description is required!</span> @enderror
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="mb-0">Company Information</h4>
                        <div class="form-group mb-0">
                            <label for="" class="col-form-label mb-0">Company</label>
                            <div class="position-relative bg-white">
                                @if (!$company)
                                <input wire:click="toggleCompany" wire:model="selectedCompanyName" class="form-control text-muted" role="button" placeholder="Select Company" readonly></input>
                                <div class="dropdown-box w-100 px-0" style="{{ $this->companyDisplayNone() }}">
                                    <input wire:model.live='companySearchTerm' class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    <ul class="dropdown-options w-100 px-0">
                                        @foreach ($companyGroup as $item)
                                        <li wire:key="{{ $item->id }}" wire:click="selectCompanyId({{ $item->id }})" class="dropdown-option d-flex align-items-center px-2 mx-0" role="button">{{ $item->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <input class="form-control text-muted" placeholder="{{ $selectedCompanyName }}" readonly></input>
                                @endif
                            </div>
                            @error('selectedCompanyId') <span class="error">A company is required!</span> @enderror
                        </div>

                    </div>
                    @if($this->editJobList)
                    <div class="form-group mb-0 d-flex flex-column">
                        <label for="" class="col-form-label mb-0">Job List Status</label>
                        @if ($jobActiveStatus)
                        <button class="btn btn-success" wire:click="$set('jobActiveStatus', false)">OPEN</button>
                        @else
                        <button class="btn btn-secondary" wire:click="$set('jobActiveStatus', true)">CLOSED</button>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        @if ($this->confirmDeletion)
                        <p class="align-self-end mx-5">Are you sure you want to delete?</p>
                        <button class="btn btn-info mt-5" wire:click="$set('confirmDeletion', null)">No</button>
                        <button class="btn btn-danger mx-2 mt-5" wire:click="deleteJobList">Yes</button>
                        @else
                        <x-template.button color="danger" class="mx-2 mt-5" wire:click="$set('confirmDeletion','true')">
                            Delete
                        </x-template.button>
                        <x-template.button color="success" class="mx-2 mt-5" wire:click="updateJobList">
                            Save
                        </x-template.button>
                        @endif
                    </div>
                    @else
                    <x-template.button color="success" class="ml-auto mt-5 align-self-end" wire:click="createJobList">
                        Create
                    </x-template.button>
                    @endif
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
