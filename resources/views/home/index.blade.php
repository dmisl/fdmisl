@extends('layouts.base')

@section('title', '')

@section('content')

<x-container class="mt-5">
    <x-container>
        @isset($recommend)
        <div class="alert alert-primary" role="alert">
            <x-title class="h3">
                {{ __('Можливо ви його знаєте?') }}
            </x-title>
            <div class="d-flex">
                <x-avatar user_id="{{ $recommend->id }}"></x-avatar>
                <div class="ms-3">
                    <h3>{{ name($recommend->id) }}</h3>
                    <x-form action="{{ route('addFriend') }}">
                        <input type="hidden" name="request_from" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="request_to" value="{{ $recommend->id }}">
                        <x-button type="submit">
                            {{ __('Так, добавити в друзі') }}
                        </x-button>
                    </x-form>
                </div>
            </div>
        </div>
        @endisset
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
                            <button class="border-0 bg-white" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ isSaved($post->id) ? __('Видалити з збережених') : __('Додати в збережені') }}">
                                <img style="width: 20px;" src="{{ asset('save_icon.png') }}" alt="">
                            </button>
                        </x-form>
                        <x-form action="{{ route('like') }}">
                            <input type="hidden" name="post" value="{{ $post->id }}">
                            <button class="border-0 bg-white" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ isLiked($post->id) ? __('Забрати вподобайку') : __('Поставити вподобайку') }}">
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
</x-container>

@endsection