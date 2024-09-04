<div>
    @role(STUDENT)
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <x-template.card>
                <x-template.card-body>
                    <x-slot name="title">Personal Information</x-slot>
                    <div class="table-responsive">
                        <x-template.table>
                            @if ($students && $students->count() > 0)
                                @foreach ($students as $student)
                                    <tr>
                                        <td><strong>Prefix</td>
                                        <td>{{ $student->stud_prefix }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>First Name</td>
                                        <td>{{ $student->stud_first_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>M. I.</td>
                                        <td>{{ $student->stud_middle_initial }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Last Name</td>
                                        <td>{{ $student->stud_last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Suffix</td>
                                        <td>{{ $student->stud_suffix }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sex</td>
                                        <td>{{ $student->stud_sex }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Birthday</td>
                                        <td>{{ $student->stud_birthday }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Birth Place</td>
                                        <td>{{ $student->stud_birth_place }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tel. No.</td>
                                        <td>{{ $student->stud_student_telephone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</td>
                                        <td>{{ $student->stud_email }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No student record found.</td>
                                </tr>
                            @endif
                        </x-template.table>
                    </div>
                </x-template.card-body>
            </x-template.card>
        </div>

        <div class="col-md-6 grid-margin stretch-card" >
            <x-template.card>
                <x-template.card-body>
                    <x-slot name="title">Educational Background</x-slot>
                    <div class="table-responsive">
                        <x-template.table>
                            @if ($students && $students->count() > 0)
                                @foreach ($students as $student)
                                    <tr>
                                        <td><strong>Junior High School</td>
                                        <td>{{ $student->stud_junior_high_school }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Senior High School</strong> </td>
                                        <td>{{ $student->stud_senior_high_school }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>University</strong></td>
                                        <td>{{ $student->stud_university }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>SR-Code</td>
                                        <td>{{ $student->stud_sr_code }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Department</td>
                                        <td>{{ $student->stud_department }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Expected Graduation</td>
                                        <td>{{ $student->stud_expected_graduation }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No student record found.</td>
                                </tr>
                            @endif
                        </x-template.table>
                    </div>
                </x-template.card-body>
            </x-template.card>
        </div>
    </div>
    @endrole()

    @role(SADM)
    <div>
        <!-- Search bar -->
        <div class="col-md-5 grid-margin" role="search">
                <div class="input-group">
                    <input type="text" wire:model="searchQuery" placeholder="Search Student Name/SR-Code" class="mb-2 form-control" id="searchInput">
                    <div class="input-group-append"> 
                        <x-template.button color="primary" wire:click="triggerSearch"><i class="mdi mdi-magnify"></i></x-template.button>
                    </div>
                    <button class="btn-sm clear-button" wire:click="clearSearch"><i class="mdi mdi-close"></i></button>
                </div>
            </div>

        <div class="col-md-12 grid-margin stretch-card">
            <x-template.card>
                <x-template.card-body>
                    <x-slot name="title">Student List</x-slot>
                    <div class="table-responsive">
                        <x-template.table :head="['SR-Code', 'Prefix', 'First Name', 'M.I.', 'Last Name', 'Suffix', 'Department' ]">
                            @if ($students && $students->count() > 0)
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->stud_sr_code }}</td>
                                        <td>{{ $student->stud_prefix }}</td>
                                        <td>{{ $student->stud_first_name }}</td>
                                        <td>{{ $student->stud_middle_initial }}</td>
                                        <td>{{ $student->stud_last_name }}</td>
                                        <td>{{ $student->stud_suffix }}</td>
                                        <td>{{ $student->stud_department }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">No student record found.</td>
                                </tr>
                            @endif
                        </x-template.table>
                    </div>
                    <!-- Pagination controls -->
                    <div class="pagination-controls">
                        {{ $students->links() }}
                    </div>
                </x-template.card-body>
            </x-template.card>
        </div>
    </div>

    @endrole()

    @role(HEAD)
    <div>
        <!-- Search bar -->
        <div class="col-md-5 grid-margin" role="search">
                <div class="input-group">
                    <input type="text" wire:model="searchQuery" placeholder="Search Student Name/SR-Code" class="mb-2 form-control" id="searchInput">
                    <div class="input-group-append"> 
                        <x-template.button color="primary" wire:click="triggerSearch"><i class="mdi mdi-magnify"></i></x-template.button>
                    </div>
                    <button class="btn-sm clear-button" wire:click="clearSearch"><i class="mdi mdi-close"></i></button>
                </div>
            </div>

        <div class="col-md-12 grid-margin stretch-card">
            <x-template.card>
                <x-template.card-body>
                    <x-slot name="title">Student List</x-slot>
                    <div class="table-responsive">
                        <x-template.table :head="['SR-Code', 'Prefix', 'First Name', 'M.I.', 'Last Name', 'Suffix', 'Department' ]">
                            @if ($students && $students->count() > 0)
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->stud_sr_code }}</td>
                                        <td>{{ $student->stud_prefix }}</td>
                                        <td>{{ $student->stud_first_name }}</td>
                                        <td>{{ $student->stud_middle_initial }}</td>
                                        <td>{{ $student->stud_last_name }}</td>
                                        <td>{{ $student->stud_suffix }}</td>
                                        <td>{{ $student->stud_department }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">No student record found.</td>
                                </tr>
                            @endif
                        </x-template.table>
                    </div>
                    <!-- Pagination controls -->
                    <div class="pagination-controls">
                        {{ $students->links() }}
                    </div>
                </x-template.card-body>
            </x-template.card>
        </div>
    </div>

    @endrole()
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.style.transition = "opacity 0.5s";
                    flashMessage.style.opacity = 0;
                    setTimeout(function() {
                        flashMessage.remove();
                    }, 500);
                }
            }, 3000);

             // event listener for the search input
        const searchInput = document.getElementById('searchInput');

            if (searchInput) {
                searchInput.addEventListener('keypress', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        // Trigger the Livewire method
                        @this.call('triggerSearch');

                        //clear the search field
                        // setTimeout(function() {
                        //     searchInput.value = '';
                        // },900);
                    }
                });
            }
        });
    </script>
