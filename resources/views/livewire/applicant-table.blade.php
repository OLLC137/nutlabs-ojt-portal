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
        <!-- Applicant List Card -->
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
                        <tbody id="applicant-list">
                            @foreach($applicants as $applicant)
                                <tr data-id="{{ $applicant->id }}" class="applicant-row">
                                    <td>{{ $applicant->student->stud_sr_code }}</td>
                                    <td>{{ $applicant->student->stud_first_name }}</td>
                                    <td>{{ $applicant->student->stud_middle_initial }}</td>
                                    <td>{{ $applicant->student->stud_last_name }}</td>
                                    <td>{{ $applicant->student->stud_suffix }}</td>
                                    <td>{{ $applicant->student->stud_department }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" onclick="acceptApplicant(event, {{ $applicant->id }})">Accept</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteApplicant(event, {{ $applicant->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modals for Accept and Delete -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="confirmationModalBody">Are you sure you want to perform this action?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Centered Notification Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center" id="notificationMessage"></div>
            </div>
        </div>
    </div>

    <script>
        let selectedApplicantId = null;
        let actionType = '';

        function acceptApplicant(event, applicantId) {
            event.stopPropagation();
            selectedApplicantId = applicantId;
            actionType = 'accept';
            document.getElementById('confirmationModalBody').innerText = "Are you sure you want to accept this applicant?";
            $('#confirmationModal').modal('show');
        }

        function deleteApplicant(event, applicantId) {
            event.stopPropagation();
            selectedApplicantId = applicantId;
            actionType = 'delete';
            document.getElementById('confirmationModalBody').innerText = "Are you sure you want to delete this applicant?";
            $('#confirmationModal').modal('show');
        }

        document.getElementById('confirmButton').addEventListener('click', function () {
            if (!selectedApplicantId) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const url = actionType === 'accept' ? `/applicants/${selectedApplicantId}/accept` : `/applicants/${selectedApplicantId}`;
            const method = actionType === 'accept' ? 'POST' : 'DELETE';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: actionType === 'accept' ? JSON.stringify({ status: 1 }) : null
            })
            .then(response => response.json())
            .then(data => {
            $('#confirmationModal').modal('hide');
            // Show the notification and wait longer before reloading
            showCenteredAlert(data.message || (actionType === 'accept' ? 'Applicant accepted.' : 'Applicant deleted.'));
            setTimeout(() => {
            location.reload(); }, 5000); // Adjust this value to 5000 milliseconds (5 seconds) or longer as needed
})

            .catch(error => {
                console.error('Error:', error);
                showCenteredAlert('An error occurred. Please try again.', 'danger');
            });
        });

        function triggerSearch() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const applicantRows = document.querySelectorAll('.applicant-row');

            applicantRows.forEach(row => {
                const srCode = row.cells[0].textContent.toLowerCase();
                const firstName = row.cells[1].textContent.toLowerCase();
                const lastName = row.cells[3].textContent.toLowerCase();

                row.style.display = (srCode.includes(query) || firstName.includes(query) || lastName.includes(query)) ? '' : 'none';
            });
        }

        function clearSearch() {
            document.getElementById('searchInput').value = '';
            const applicantRows = document.querySelectorAll('.applicant-row');
            applicantRows.forEach(row => row.style.display = '');
        }

        function showCenteredAlert(message) {
            document.getElementById('notificationMessage').innerText = message;
            $('#notificationModal').modal('show');
            setTimeout(() => $('#notificationModal').modal('hide'), 5000);
        }

        document.getElementById('searchInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                triggerSearch();
            }
        });
    </script>

    <!-- Ensure Bootstrap and jQuery are included for modal functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>
