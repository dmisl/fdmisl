@extends('layouts.base')

@section('title', __('Збережені пости'))

@section('content')

<x-container style="width: 50vw;">
    <x-title class="mb-3">
        {{ __('Збережені пости') }}
    </x-title>

    <div class="saved">
        @if(isset($posts))
            @foreach($posts as $post)
                <x-card>
                    <x-card-body>
                        <x-title class="d-flex">
                            <x-avatar user_id="{{ $post->user_id }}" />
                            <div>
                                {{ $post->user_name }}
                            </div>
                        </x-title>
                        <div class="h6 small text-muted">
                            {{ $post->created_at }}
                        </div>
                        @if($post->image)
                        
                            <img style="width:50%;" src="{{ asset('/storage/'.$post->image) }}" alt="">
                    
                        @endif
                        <p>
                            {{ $post->text }}
                        </p>
                    </x-card-body>
                </x-card>
            @endforeach
        @else
            <h4>
                {{ __('Немає збережених постів') }}
            </h4>
        @endif
    </div>
</x-container>

@endsection