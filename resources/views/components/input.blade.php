@props([
    'name' => '',
])

<input name="{{ $name }}" {{ $attributes->class([
    'form-control',    
])->merge([
    'type' => 'text'    
]) }}>

@error($name)

<p class="text-danger small">
    {{ $errors->first($name) }}
</p>

@enderror