@extends('layouts.base')

@section('title', $user->name)

@section('content')

<x-container class="bg-light">
    <x-avatar width="100px" user_id="{{ $user->id }}"></x-avatar>
    <x-title>
        {{ $user->name }}
    </x-title>
    <a href="{{ route('profile.friends', $user->id) }}">
        {{ __('Список друзів') }}
    </a>
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
        <x-card-body class="border-bottom">
                <x-title class="h5 d-flex">
                    <x-avatar width="25px" user_id="{{ $post->user_id }}"></x-avatar>
                    <div class="ms-2">
                        {{ $post->user_name }}
                    </div>
                    <div class="d-flex ms-auto" style="height: 20px;">
                        <x-form action="{{ route('save') }}">
                            <input type="hidden" name="post" value="{{ $post->id }}">
                            <button class="border-0 bg-white" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ isSaved($post->id) ? __('Видалити з збережених') :__('Додати в збережені') }}">
                                <img style="width: 20px;" src="{{ asset('save_icon.png') }}" alt="">
                            </button>
                        </x-form>
                        <x-form action="{{ route('like') }}">
                            <input type="hidden" name="post" value="{{ $post->id }}">
                        <button class="border-0 bg-white" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ isLiked($post->id) ? __('Забрати вподобайку') :__('Поставити вподобайку') }}">
                            <img style="width: 20px;" src="{{ asset('like_icon.png') }}" alt="">
                        </button>
                    </x-form>
                </div>
            </x-title>
            <div class="small text-muted">
                {{ $post->created_at }}
            </div>
            <img style="width: 500px;" class="rounded-3" src="{{ asset('/storage/'.$post->image) }}">
            <p>
                {{ $post->text }}
            </p>
            <x-form action="comment">
                <x-form-item>
                    <x-input placeholder="{{ __('Прокоментуйте пост') }}" name="content" />
                </x-form-item>
                <x-form-item>
                    <input type="hidden" name="post" value="{{ $post->id }}">
                    <x-button class="btn-sm" type="submit">
                        {{ __('Прокоментувати') }}
                    </x-button>
                </x-form-item>
            </x-form>
        </x-card-body>
    </x-card>
    @endforeach
    @endisset
</x-container>

@endsection