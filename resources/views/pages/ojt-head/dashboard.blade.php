<x-app-layout>
    <x-slot name="header">
        <div class="page-header">
            <h3 class="page-title"></h3>
        </div>
    </x-slot>
    <div class="row">
        <div class="col-md-6">
        @livewire('department-enrolled')
        </div>
       <div class="col-md-6">
       @livewire('pending-requirements')
       </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @livewire('partner-industry')
        </div>
        <div class="col-md-6">
            @livewire('ongoing-intern')
        </div>
    </div>
</x-app-layout>
