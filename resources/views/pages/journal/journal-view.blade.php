<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <!-- Print Button (aligned to the right) -->


    @livewire('journal-view')

    <div style="display: flex; justify-content:center; margin-top: 20px;">
        <x-template.button onclick="window.print()" color=info>
            Print Report
        </x-template.button>
    </div>
        

    <!-- CSS Import -->
    @vite('resources/css/journal-view.css')
</x-app-layout>
