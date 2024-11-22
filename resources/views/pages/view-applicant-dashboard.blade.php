<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row">
        <div class="col-md-6"> @livewire('applicant-dashboard')</div>
        <div class="col-md-6"> @livewire('joblist-dashboard')</div>
    </div>
</x-app-layout>
