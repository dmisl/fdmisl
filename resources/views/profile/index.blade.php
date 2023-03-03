@extends('layouts.base')

@section('title', auth()->user()->name)

@section('content')

<x-container class="bg-light">
    <div class="rounded-circle" style="width: 100px;">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal">
            <x-avatar class="changeAvatar" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" />
        </a>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Змінити аватарку') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('avatar') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <x-form-item>
                                <x-input type="file" name="avatar"></x-input>
                            </x-form-item>
                            <x-form-item>
                                <x-button type="submit">
                                    {{ __('Змінити') }}
                                </x-button>
                            </x-form-item>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-title>
        {{ auth()->user()->name }}
    </x-title>
    @if(status(auth()->user()->id))
    <x-form action="{{ route('status') }}">
        <x-input name="status" style="width: 200px; height:20px;" value="{{ auth()->user()->status }}" />
    </x-form>
    @else
    <x-form action="{{ route('status') }}">
        <x-input name="status" style="width: 200px; height:20px;" placeholder="{{ __('Статус профіля') }}" />
    </x-form>
    @endif
    <a href="{{ route('profile.friends', auth()->user()->id) }}">
        {{ __('Список друзів') }}
    </a>
    <x-form enctype="multipart/form-data" action="{{ route('profile.store') }}">
        <x-input name="text" placeholder="{{ __('Що нового') }}" />
        <x-input type="hidden" name="posted_to" value="{{ auth()->user()->id }}"></x-input>
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
                    <div class="dropdown">
                        <button class="border-0 bg-white" type="submit" id="dropdownMenuButton{{ $post->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                            <img style="width: 20px;" src="{{ asset('settings-2.png') }}" alt="">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $post->id }}">
                            <x-form action="{{ route('delete') }}">
                                <li>
                                    <input type="hidden" name="remove" value="{{ $post->id }}">
                                    <button type="submit" class="dropdown-item" href="{{ route('delete') }}">
                                        {{ __('Видалити') }}
                                    </button>
                                </li>
                            </x-form>
                        </ul>
                    </div>
                </div>
            </x-title>
            <div class="small text-muted">
                {{ $post->created_at }}
            </div>
            <img style="width: 500px;" class="rounded-3" src="{{ asset('/storage/'.$post->image) }}">
            <p>
                {{ $post->text }}
            </p>
            <div class="comments border-bottom mb-3">
                @if($comments = comments($post->id))
                @foreach($comments as $comment)
                <x-card class="mb-3">
                    <h6 class="m-0 pb-0 d-flex border-bottom-0">
                        <x-avatar width="20px" user_id="{{ $comment->user }}"></x-avatar>
                        {{ name($comment->user) }}
                        <div class="ms-auto small text-muted">
                            {{ $comment->created_at }}
                        </div>
                    </h6>
                    <p style="font-size: 13px;" class="m-0">{{ $comment->content }}</p>
                </x-card>
                @endforeach
                @endif
            </div>
            <x-form action="{{ route('comment')}}">
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