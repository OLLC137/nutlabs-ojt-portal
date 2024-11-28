<div>
    <!-- Search bar -->
    <div class="mb-3">
        <div class="input-group" role="search">
            <input
                type="text"
                id="searchInput"
                placeholder="Search by SR-Code or Name"
                class="form-control"
                wire:model.debounce.500ms="searchQuery"
                wire:keydown.enter="search"  <!-- Trigger search when 'Enter' key is pressed -->

            <div class="input-group-append">
                <button class="btn btn-primary" wire:click="search">
                    <i class="mdi mdi-magnify"></i> Search
                </button>
            </div>
            <button class="btn btn-sm clear-button" wire:click="clearSearch">
                <i class="mdi mdi-close"></i>
            </button>
        </div>
    </div>

    <!-- Applicants Table -->
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Applicant List</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SR-Code</th>
                                <th>First Name</th>
                                <th>M.I.</th>
                                <th>Last Name</th>
                                <th>Suffix</th>
                                <th>Department</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applicants as $applicant)
                                <tr>
                                    <td>{{ $applicant->student->stud_sr_code }}</td>
                                    <td>{{ $applicant->student->stud_first_name }}</td>
                                    <td>{{ $applicant->student->stud_middle_initial }}</td>
                                    <td>{{ $applicant->student->stud_last_name }}</td>
                                    <td>{{ $applicant->student->stud_suffix }}</td>
                                    <td>{{ $applicant->student->stud_department }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" wire:click="confirmAction({{ $applicant->id }}, 'accept')">Accept</button>
                                        <button class="btn btn-danger btn-sm" wire:click="confirmAction({{ $applicant->id }}, 'delete')">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $applicants->links() }}
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    @if($applicantIdToDelete)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to {{ $actionType === 'accept' ? 'accept' : 'delete' }} this applicant?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('applicantIdToDelete', null)">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click="executeAction">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Success Message -->
    @if ($successMessage)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $successMessage }}
            <button type="button" class="btn-close" aria-label="Close" wire:click="$set('successMessage', null)"></button>
        </div>
    @endif
</div>
















