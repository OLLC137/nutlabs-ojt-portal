@props([
    'color', 
    'variant', 
    'size',
    'rounded' => false, 
    'fw'=> false,
    'icon' => false,
    'block' => false
])

@php
    $type = "";
    $v = (!empty($variant)) ? sprintf("-%s-", $variant) : "-";
    switch ($color) {
        case 'secondary':
            $type = sprintf("btn%ssecondary", $v);
            break;
        case 'success':
            $type = sprintf("btn%ssuccess", $v);
            break;
        case 'danger':
            $type = sprintf("btn%sdanger", $v);
            break;
        case 'warning':
            $type = sprintf("btn%swarning", $v);
            break;
        case 'info':
            $type = sprintf("btn%sinfo", $v);
            break;
        case 'light':
            $type = sprintf("btn%slight", $v);
            break;
        case 'dark':
            $type = sprintf("btn%sdark", $v);
            break;
        case 'link':
            $type = "btn-link";
            break;
        default:
            $type = sprintf("btn%sprimary", $v);
            break;
    }
    
    $shape = "";
    if($rounded) { $shape = "btn-rounded"; }
    
    $btnFw = "";
    if($fw) {
        $btnFw = "btn-fw";
    }
    
    $btnIcon = "";
    if($icon) {
        $btnIcon = "btn-icon";
    }
    
    $btnSize = "";
    if(!empty($size)) {
        $btnSize = sprintf("btn-%s", $size);
    }
    
    $btnBlock = "";
    if($block) {
        $btnBlock = "btn-block";
    }
    
    $class = sprintf(
        'btn %s %s %s %s %s %s', 
        $type,  
        $shape, 
        $btnFw, 
        $btnIcon,
        $btnSize,
        $btnBlock
    );

@endphp

<button {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</button>