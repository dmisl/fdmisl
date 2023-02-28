@php($uuid = (string) Str::uuid())

<input type="checkbox" {{ $attributes }} id="{{ $uuid }}" value="1">
<label for="{{ $uuid }}">{{ $slot }}</label>