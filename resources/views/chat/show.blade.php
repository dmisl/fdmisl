@extends('layouts.chat')


@section('chat.content')

<div class="users bg-light">
    @isset($friends)

    @foreach($friends as $friend)
    <a href="{{ route('chat.show', $friend->friend) }}">
        <div class="user border-bottom d-flex">
            <x-avatar user_id="{{ $friend->friend }}" width="75px; height:75px;"></x-avatar>
            <div>
                <h6>
                    {{ name($friend->friend) }}
                </h6>
            </div>
        </div>
    </a>
    @endforeach
    @endisset
</div>
<div class="chat">
    <div class="chat-title">
        <h5 class="pt-2 ps-2">
            {{ $user->name }}
        </h5>
    </div>
    <div class="chat-messages">
        @if($messages)
        @foreach($messages as $message)
        @if($message->sender == auth()->user()->id)
        <div class="message ms-auto rounded-3 bg-grey m-2">
            <h6 class="ms-2 my-0">
                {{ name($message->sender) }}
            </h6>
            @if($message->image)
            <img src="{{ asset('/storage/'.$message->image) }}" alt="">
            @endif
            <p class="p-2">
                {{ $message->message }}
            </p>
        </div>
        @else
        <div class="message me-auto rounded-3 bg-grey m-2">
            <h6 class="ms-2 my-0">
                {{ name($message->sender) }}
            </h6>
            @if($message->image)
            <img src="{{ asset('/storage/'.$message->image) }}" alt="">
            @endif
            <p class="p-2">
                {{ $message->message }}
            </p>
        </div>
        @endif
        @endforeach
        @endif
    </div>
    <div class="chat-input">
        <x-form enctype="multipart/form-data" action="{{ route('chat.store') }}">
            <div class="input-group mb-3">
                <input type="hidden" name="receiver" value="{{ $user->id }}">
                <input type="text" name="text" style="height:50px;" class="form-control" placeholder="{{ __('Напишіть щось до ').$user->name }}" aria-label="Recipient's username" aria-describedby="button-addon2">
                <label for="file" class="btn btn-outline-secondary" style="height:50px;" type="button" id="button-addon2">
                    <img style="width: 36px;" src="{{ asset('image.png') }}" alt="">
                </label>
            </div>
            <input name="image" style="height:50px; display:none;" class="btn btn-outline-secondary" type="file" id="file">
        </x-form>
    </div>
</div>

@endsection