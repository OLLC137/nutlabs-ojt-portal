@php
$class = sprintf("mdi mdi-%s", $slot);
@endphp

<i {{ $attributes->merge(['class' => $class]) }}"></i> 