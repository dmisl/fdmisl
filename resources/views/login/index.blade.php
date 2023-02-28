@extends('layouts.auth')

@section('title', __('Авторизація'))

@section('auth.content')

<x-card-body class="border-bottom">
    <x-title class="mb-3">
        {{ __('Авторизація') }}
    </x-title>
    <x-form action="{{ route('login.store') }}">
        <x-form-item>
            <x-input name="email" placeholder="Електронна пошта" />
        </x-form-item>
        <x-form-item>
            <x-input type="password" name="password" placeholder="Пароль" />
        </x-form-item>
        <x-form-item>
            <x-checkbox name="remember">
                {{ __('Запамятати мене') }}
            </x-checkbox>
        </x-form-item>
        <x-button type="submit">
            {{ __('Ввійти') }}
        </x-button>
    </x-form>
</x-card-body>
<x-card-body>
    <a class="small" href="{{ route('register.index') }}">
        {{ __('Ще не зареєстровані?') }}
    </a>
</x-card-body>

@endsection