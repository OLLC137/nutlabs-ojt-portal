<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="d-flex justify-content-between">
        <h1>Job Listings</h1>
        <a href="/joblist">you can also view job postings in the home page</a>
    </div>
    @livewire('student-joblist')
</x-app-layout>
