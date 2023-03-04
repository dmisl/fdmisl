@extends('layouts.base')

@section('title', __('Друзі ').$user->name)

@section('content')

<x-container>
    <x-title>
        {{ __('Друзі ').$user->name }}
    </x-title>
    <x-card>
        <a href="{{ route('profile.show', $user->id) }}">
            {{ __('Назад') }}
        </a>
        <x-card-body class="d-flex">
            <div>
                <x-avatar user_id="{{ $user->id }}"></x-avatar>
            </div>
            <div>
                <x-title class="border-bottom-0 mt-4 ms-3">
                    {{ $user->name }}
                </x-title>
            </div>
        </x-card-body>
    </x-card>
    @if(isset($friends))
    @foreach($friends as $friend)
    <x-card>
        <x-card-body class="row d-flex">
            <div class="col-md-2">
                <x-avatar user_id="{{ $friend['friend'] }}"></x-avatar>
            </div>
            <div class="col-md-5">
                <a href="{{ route('profile.show', $friend['friend']) }}">
                    <x-title class="border-bottom-0 mt-3">{{ name($friend['friend']) }}</x-title>
                </a>
            </div>
            @if($friend['user'] == auth()->user()->id)
            <div class="col-md-1 ms-auto">
                <div class="btn-group">
                    <a class="nav-link border rounded-3" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="navbar-img" src="{{ asset('settings.png') }}" alt="">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="text-decoration-none" href="{{ route('chat.show', $friend['friend']) }}">
                                <button class="dropdown-item">
                                    {{ __('Написати повідомлення') }}
                                </button>
                            </a>
                        </li>
                        <li>
                            <x-form action="{{ route('removeFriend') }}">
                                <input type="hidden" name="remove" value="{{ $friend['friend'] }}">
                                <input type="hidden" name="user" value="{{ $friend['user'] }}">
                                <x-button class="dropdown-item text-danger" type="submit">
                                    {{ __('Видалити друга') }}
                                </x-button>
                            </x-form>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
        </x-card-body>
    </x-card>
    @endforeach
    @else
    {{ __('У вас немає друзів') }}
    @endif
</x-container>
@endsection