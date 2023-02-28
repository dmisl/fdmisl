@extends('layouts.auth')

@section('title', __('Реєстрація'))

@section('auth.content')

<x-card-body class="border-bottom">
    <x-title class="mb-3">
        {{ __('Реєстрація') }}
    </x-title>
    <x-form action="{{ route('register.store') }}">
        <x-form-item>
            <x-input name="email" placeholder="Електронна пошта" />
        </x-form-item>
        <x-form-item>
            <x-input name="name" placeholder="Імя" />
        </x-form-item>
        <x-form-item>
            <x-input type="password" name="password" placeholder="Пароль" />
        </x-form-item>
        <x-form-item>
            <x-input type="password" name="password_confirmation" placeholder="Підтвердження пароля" />
        </x-form-item>
        <x-form-item>
            <x-checkbox name="agreement">
                {{ __('Я згоджуюсь з правилами сайту') }}
            </x-checkbox>
        </x-form-item>
        <x-button type="submit">
            {{ __('Зареєструватись') }}
        </x-button>
    </x-form>
</x-card-body>
<x-card-body>
    <a class="small" href="{{ route('login.index') }}">
        {{ __('У вас уже є аккаунт?') }}
    </a>
</x-card-body>

@endsection