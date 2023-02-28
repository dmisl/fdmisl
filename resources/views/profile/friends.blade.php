@extends('layouts.base')

@section('title', __('Друзі ').$user->name)

@section('content')

<x-container>
    <x-title>
        {{ __('Друзі ').$user->name }}
    </x-title>
    <x-card>
        <x-card-body class="d-flex">
            <div>
                <x-avatar user_id="{{ $user->id }}"></x-avatar>
            </div>
            <div>
                <x-title>
                    dfg
                </x-title>
            </div>
        </x-card-body>
    </x-card>
    <x-card>
        <x-card-body>

        </x-card-body>
    </x-card>
</x-container>

@endsection