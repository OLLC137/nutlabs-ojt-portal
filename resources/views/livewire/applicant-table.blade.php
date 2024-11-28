<div>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Search bar -->
    <div class="mb-3">
        <div class="input-group" role="search">
            <input type="text" id="searchInput" placeholder="Search by SR-Code or Name" class="form-control">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="triggerSearch()">
                    <i class="mdi mdi-magnify"></i>
                </button>
            </div>
            <button class="btn btn-sm clear-button" onclick="clearSearch()">
                <i class="mdi mdi-close"></i>
            </button>
        </div>
    </div>

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
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Year Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="applicant-list">
                            @foreach ($applicants as $applicant)
                                <tr data-id="{{ $applicant->id }}" class="applicant-row">
                                    <td>{{ $applicant->student->stud_sr_code }}</td>
                                    <td>{{ $applicant->student->stud_first_name }}</td>
                                    <td>{{ $applicant->student->stud_last_name }}</td>
                                    <td>{{ $applicant->student->stud_department }}</td>
                                    <td>{{ $applicant->student->stud_year_level }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm">View</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
                    <!-- Removed the close (X) button -->
                </div>
                <div class="modal-body" id="confirmationModalBody">Are you sure you want to perform this action?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelButton">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Centered Notification Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog"
        aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center" id="notificationMessage"></div>
            </div>
        </div>
    </div>
</div>
