    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

    @role(SADM)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('landing-page') }}">
        <x-template.icon class="menu-icon"> account-box </x-template.icon>
            <span class="menu-title">Get Started</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('view-cv-page') }}">
        <x-template.icon class="menu-icon"> account-multiple </x-template.icon>
            <span class="menu-title">Student List</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('intern-requirements') }}">
            <x-template.icon class="menu-icon"> clipboard-check </x-template.icon>
            <span class="menu-title">Upload Requirements</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <x-template.icon class="menu-icon"> book </x-template.icon>
            <span class="menu-title">Accomplishment</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('journal.journal-post') }}">Journal Posting</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('journal.journal-view') }}">Journal Viewing</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ojt-head-dashboard') }}">
        <x-template.icon class="menu-icon"> view-dashboard </x-template.icon>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basics" aria-expanded="false" aria-controls="ui-basic">
        <x-template.icon class="menu-icon"> account-multiple-outline </x-template.icon>
            <span class="menu-title">Partner Industries</span>
            <i class="menu-arrow"></i>

        </a>
        <div class="collapse" id="ui-basics">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('view-company-page') }}">Company List</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('add-company-page') }}">Add Company</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('managejobs') }}">
        <x-template.icon class="menu-icon"> briefcase </x-template.icon>
            <span class="menu-title">Job Listings</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('manage-student-files') }}">
        <x-template.icon class="menu-icon"> account-multiple </x-template.icon>
            <span class="menu-title">Student Files</span>
        </a>
    </li>
    @endrole()

    @role(COMPANY)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('applicant-dashboard') }}">
            <a class="nav-link" href="{{ route('ojt-head-dashboard') }}">
                <x-template.icon class="menu-icon"> view-dashboard </x-template.icon>
            <span class="menu-title">Applicant Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('view-applicants') }}">
            <x-template.icon class="menu-icon"> account-multiple </x-template.icon>
            <span class="menu-title">View Applicants</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('edit') }}">
            <x-template.icon class="menu-icon"> pencil </x-template.icon>
            <span class="menu-title">Edit Company Info</span>
        </a>
    </li>
    @endrole()

            @role(STUDENT)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('landing-page') }}">
                        <x-template.icon class="menu-icon"> account-box </x-template.icon>
                        <span class="menu-title">Get Started</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('view-cv-page') }}">
                        <x-template.icon class="menu-icon"> account-box </x-template.icon>
                        <span class="menu-title">CV Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('intern-requirements') }}">
                        <x-template.icon class="menu-icon"> clipboard-check </x-template.icon>
                        <span class="menu-title">Upload Requirements</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('student-joblist') }}">
                        <x-template.icon class="menu-icon"> format-list-bulleted </x-template.icon>
                        <span class="menu-title">Job Listing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <x-template.icon class="menu-icon"> book </x-template.icon>
                        <span class="menu-title">Accomplishment</span>
                        <i class="menu-arrow"></i>

                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('journal.journal-post') }}">Journal
                                    Posting</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('journal.journal-view') }}">Journal
                                    Viewing</a></li>
                        </ul>
                    </div>
                </li>
            @endrole()

    @role(HEAD)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ojt-head-dashboard') }}">
        <x-template.icon class="menu-icon"> view-dashboard </x-template.icon>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('view-cv-page') }}">
        <x-template.icon class="menu-icon"> account-multiple </x-template.icon>
            <span class="menu-title">Student List</span>
        </a>
    </li>
    @endrole()

    @role(COORDINATOR)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('view-company-page') }}">
        <x-template.icon class="menu-icon"> account-multiple-outline </x-template.icon>
            <span class="menu-title">Partner Industries</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('managejobs') }}">
        <x-template.icon class="menu-icon"> briefcase </x-template.icon>
            <span class="menu-title">Job Listings</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('manage-student-files') }}">
        <x-template.icon class="menu-icon"> account-multiple </x-template.icon>
            <span class="menu-title">Student Files</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('manage-journal-requests') }}">
        <x-template.icon class="menu-icon"> book </x-template.icon>
            <span class="menu-title">View Journal Requests</span>
        </a>
    </li>
    @endrole()

    @role(ADM)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <span class="menu-title">Dashboard</span>
            <i class="mdi mdi-home menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('icons') }}">
            <span class="menu-title">Icons</span>
            <i class="mdi mdi-home menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('forms') }}">
            <span class="menu-title">Forms</span>
            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('charts') }}">
            <span class="menu-title">Charts</span>
            <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('tables') }}">
            <span class="menu-title">Tables</span>
            <i class="mdi mdi-table-large menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
            <span class="menu-title">Sample Pages</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-medical-bag menu-icon"></i>
        </a>
        <div class="collapse" id="general-pages">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="javascript:void(0)"> Blank Page </a></li>
                <li class="nav-item"> <a class="nav-link" href="javascript:void(0)"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="javascript:void(0)"> Register </a></li>
                <li class="nav-item"> <a class="nav-link" href="javascript:void(0)"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="javascript:void(0)"> 500 </a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item sidebar-actions">
        <span class="nav-link">
            <div class="border-bottom">
                <h6 class="mb-3 font-weight-normal">Projects</h6>
            </div>
            <x-template.button color="primary" variant="gradient" size="lg" :block="true" class="mt-4"> + Add a project </x-template.button>
            <div class="mt-4">
                <div class="border-bottom">
                    <p class="text-secondary">Categories</p>
                </div>
                <ul class="mt-4 gradient-bullet-list">
                    <li>Free</li>
                    <li>Pro</li>
                </ul>
            </div>
        </span>
    </li>
    @endrole()


</ul>
</nav>
