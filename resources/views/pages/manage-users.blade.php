<x-app-layout>
    <x-slot name="header">
        <div class="page-header">
            <h3 class="page-title"> Manage Users </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> Users </a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Manage Users </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <x-template.card>
        <x-template.card-body>
            <x-slot name="title"> Users </x-slot>
            @livewire('manage-user-lists')
        </x-template.card-body>
    </x-template.card>

</x-app-layout>