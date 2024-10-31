<div>
        <!-- Search bar placed above the applicant list card -->
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
                        </tr>
                    </thead>
                    <tbody id="applicant-list">
                        <!-- Applicant list will be inserted here by JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="pagination-controls">
                <!-- Pagination controls would go here if needed -->
            </div>
        </div>
    </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.transition = "opacity 0.5s";
                flashMessage.style.opacity = 0;
                setTimeout(() => flashMessage.remove(), 500);
            }
        }, 3000);

        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    triggerSearch();
                }
            });
        }
    });

    function triggerSearch() {
        const query = document.getElementById('searchInput').value;
        // Logic to search for applicants based on query and display them in the applicant-list element
        displayApplicants(applicants);
    }

    function clearSearch() {
        document.getElementById('searchInput').value = '';
        // Logic to clear the search results
        displayApplicants(applicants); // Display all applicants when cleared
    }

    // Mock data and display logic
    const applicants = [
        { sr_code: '12345', first_name: 'John', middle_initial: 'D', last_name: 'Doe', suffix: '', department: 'Engineering' },
        { sr_code: '67890', first_name: 'Jane', middle_initial: 'A', last_name: 'Smith', suffix: 'Jr', department: 'Science' }
    ];

    function displayApplicants(data) {
        const applicantList = document.getElementById('applicant-list');
        applicantList.innerHTML = '';  // Clear existing data
        data.forEach(applicant => {
            const row = `
                <tr>
                    <td>${applicant.sr_code}</td>
                    <td>${applicant.first_name}</td>
                    <td>${applicant.middle_initial}</td>
                    <td>${applicant.last_name}</td>
                    <td>${applicant.suffix}</td>
                    <td>${applicant.department}</td>
                </tr>
            `;
            applicantList.insertAdjacentHTML('beforeend', row);
        });
    }

    // Initialize display
    displayApplicants(applicants);
</script>
