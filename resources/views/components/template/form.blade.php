@props(['submit'])

@if(!empty($submit))
<form wire:submit="{{ $submit }}" class="forms-sample"> {{ $slot }} </form>
@else
<form class="forms-sample"> {{ $slot }} </form>
@endif