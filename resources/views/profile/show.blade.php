@extends('layouts.base')

@section('title', $user->name)

@section('content')

<x-container class="bg-light">
    <x-avatar width="100px" user_id="{{ $user->id }}"></x-avatar>
    <x-title>
        {{ $user->name }}
    </x-title>
    @if(auth()->user()->id != $user->id)
    @if(friendRequest($user->id))
    <x-form action="{{ route('removeFriend') }}">
        <input type="hidden" name="remove" value="{{ $user->id }}">
        <x-button type="submit">
            {{ __('Вилучити з списку друзів') }}
        </x-button>
    </x-form>
    @else
    <x-form action="{{ route('addFriend') }}">
        <input type="hidden" name="request_from" value="{{ auth()->user()->id }}">
        <input type="hidden" name="request_to" value="{{ $user->id }}">
        <x-button type="submit">
            {{ __('Добавати в друзі') }}
        </x-button>
    </x-form>
    @endif
    @endif
    <x-form enctype="multipart/form-data" action="{{ route('profile.store') }}">
        <x-input name="text" placeholder="{{ __('Поділитись чимось з користувачем') }}" />
        <x-input type="hidden" name="posted_to" value="{{ $user->id }}"></x-input>
        <input class="form-control-file" type="file" name="image" id="image">
        <x-button type="submit">
            Надіслати
        </x-button>
    </x-form>

    @isset($posts)
    @foreach($posts as $post)
    <x-card>
        <x-card-body>
            <x-title class="h5">
                {{ $post->user_name }}
            </x-title>
            <img src="{{ asset('/storage/'.$post->image) }}" alt="">
            <p>
                {{ $post->text }}
            </p>
            <div class="small text-muted">
                {{ $post->published_at }}
            </div>
        </x-card-body>

    </x-card>
    @endforeach
    @endisset
</x-container>

@endsection