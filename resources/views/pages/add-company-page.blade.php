<x-app-layout>
    <x-slot name="header">
        <div class="page-header">
        <!-- <x-template.button type="button"  color="dark" variant="" class="me-2" onclick="window.history.back();"> Back </x-template.button>  -->
            <h3 class="page-title">Add Partner Industries </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> CV elements </li>
                </ol>
            </nav>
        </div>
        @if (session('status'))
                    <div id="flash-message" class="alert alert-success">
                        {{ session('status') }}
                    </div>
        @endif
    </x-slot>

        @livewire('add-company')
    

</x-app-layout>