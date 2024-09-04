@props(['submit'])
<x-template.card>
    <x-template.card-body>
        <x-slot name="title"> {{ $title }} </x-slot>
        <x-slot name="description">{{ $description }} </x-slot>
        @if(isset($submit))
        <x-template.form submit="{{ $submit }}"> {{ $slot }} </x-template.form>
        @else
        <x-template.form> {{ $slot }} </x-template.form>
        @endif
    </x-template.card-body>
</x-template.card>