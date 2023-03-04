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
    @yield('chat.content')
</div>

@endsection