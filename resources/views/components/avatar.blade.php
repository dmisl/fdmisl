@props([
    'user_id' => auth()->user()->id,
    'width' => '100px',
])

<img style="width: {{ $width }};" src="{{ avatar($user_id) }}" {{ $attributes->class([
    'rounded-circle',    
]) }}>