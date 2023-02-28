@props([
    'method' => 'POST',    
])

@php

$method = strtoupper($method);
$_method = in_array($method, ['GET', 'POST']);

@endphp

<form method="{{ $_method ? $method : 'POST' }}" {{ $attributes }}>
    @if(!$_method)
        @method($method)
    @endif
    @if($method !== 'GET')
        @csrf
    @endif
    {{ $slot }}
</form>