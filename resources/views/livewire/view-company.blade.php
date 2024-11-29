<div>
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
        <div>
            <h3 class="mb-4 page-title"> {{ $co_name }} </h3>
        </div>
</div>

<script>
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
