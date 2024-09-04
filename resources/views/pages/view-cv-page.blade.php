<x-app-layout>
    <x-slot name="header">
        <div class="page-header">
            <h3 class="page-title"> View CV </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @role(STUDENT)
                    <li class="breadcrumb-item"><a href="{{ route('cv-profile-page') }}"> CV Fill-up </a></li>
                    <li class="breadcrumb-item"><a href="{{ route('edit-cv-page') }}"> Edit </a></li>
                    @endrole()
                    @role(HEAD)
                    <li class="breadcrumb-item"><a href="{{ route('delete-cv-page') }}"> Archive </a></li>
                    @endrole()
                    @role(SADM)
                    <li class="breadcrumb-item"><a href="{{ route('cv-profile-page') }}"> CV Fill-up </a></li>
                    <li class="breadcrumb-item"><a href="{{ route('edit-cv-page') }}"> Edit </a></li>
                    <li class="breadcrumb-item"><a href="{{ route('delete-cv-page') }}"> Archive </a></li>
                    @endrole()
                    <li class="breadcrumb-item active" aria-current="page"> CV elements </li>
                </ol>
            </nav>
        </div>
        @if (session('error'))
            <div id="flash-message" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </x-slot>

            @livewire('view-cv')

            @vite('resources/css/view-cv.css')
</x-app-layout>

