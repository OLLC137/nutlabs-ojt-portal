<div>
    @if ($selectedCompanyId == null)
        <div>
            <h3 class="mb-4 page-title"> Partner Industry List </h3>
        </div>
        <div class="row">

            <div class="col-md-6 grid-margin" role="search">
                <div class="input-group">
                    <input type="text" wire:model="searchQuery" placeholder="Search Company Name..."
                        class="mb-2 form-control" id="searchInput">
                    <div class="input-group-append">
                        <x-template.button color="primary" wire:click="triggerSearch"><i
                                class="mdi mdi-magnify"></i></x-template.button>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-md-6 d-flex justify-content-end">
                <div>
                    <x-template.button variant="inverse" :rounded="true" color="primary"
                        wire:click="setFilter(null)">All</x-template.button>
                    <x-template.button variant="inverse" :rounded="true" color="primary"
                        wire:click="setFilter(1)">Active</x-template.button>
                    <x-template.button variant="inverse" :rounded="true" color="primary"
                        wire:click="setFilter(0)">Inactive</x-template.button>
                </div>
            </div>

        </div>

        <div class="mb-2 col-md-12 stretch-card">
            <x-template.card>
                <x-template.card-body>
                    <x-slot name="title">Company Information</x-slot>
                    <x-template.table :head="['Company Name', 'Company Contact Number', 'Company Email', 'Company Status']">
                        @foreach ($companies as $company)
                            <tr wire:click="selectCompany({{ $company->id }})" style="cursor: pointer;">
                                <td>{{ $company->co_name }}</td>
                                <td>{{ $company->co_contact_number }}</td>
                                <td>{{ $company->co_email }}</td>
                                <td>{!! $this->getStatus($company->co_isactive) !!}</td>
                            </tr>
                        @endforeach
                    </x-template.table>
                </x-template.card-body>
            </x-template.card>
        </div>

        <div class="pagination-controls">
            {{ $companies->links() }}
        </div>
    @else
        <div>
            <h3 class="mb-4 page-title"> {{ $co_name }} </h3>
        </div>


        <div class="row">
            <div class="mt-2 mb-2 col-md-6 stretch-card">
                <x-template.card>
                    <x-template.card-body>
                        <x-slot name="title">View & Edit Company Information</x-slot>
                        <x-template.table>
                            <tr>
                                <td><strong>Company Name</td>
                                <td><input type="text" wire:model="co_name" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><strong>Company Address</td>
                                <td><input type="text" wire:model="co_address" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><strong>Company Tel. No.</td>
                                <td><input type="text" wire:model="co_contact_number" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><strong>Company Email</td>
                                <td><input type="text" wire:model="co_email" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><strong>Company Status</td>
                                <td>
                                    <select wire:model="co_isactive" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Company Website</td>
                                <td><input type="text" wire:model="co_website" class="form-control"></td>
                            </tr>
                        </x-template.table>
                    </x-template.card-body>
                </x-template.card>
            </div>
        </div>
        <div>
            <x-template.button color="secondary" wire:click="resetCompanyDetail">Back to List</x-template.button>
            <x-template.button color="primary" wire:click="saveCompanyDetails">Save</x-template.button>
            <button wire:click.stop type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#deleteModal">
                Archive
            </button>
        </div>
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to Archive the record
                            of this Company?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (session('status'))
                            <div id="flash-message" class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" wire:click.stop="delete({{ $selectedCompanyId }})"
                            class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            // Find the flash message element
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                // Fade out and remove the flash message
                flashMessage.style.transition = "opacity 0.5s";
                flashMessage.style.opacity = 0;
                setTimeout(function() {
                    flashMessage.remove();
                }, 500); // Match this time with the CSS transition duration
            }
        }, 3000); // Duration to show the message

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
