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
        <x-card-body>
            <x-title class="h5">
                {{$post->user_name}}
            </x-title>
            {{$post->text}}
        </x-card-body>
    </x-card>
    @endforeach
    @endisset
</x-container>

@endsection