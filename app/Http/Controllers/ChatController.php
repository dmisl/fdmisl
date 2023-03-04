<?php

namespace App\Http\Controllers;

use App\Models\FriendList;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $friends = FriendList::query()
        ->where('user', auth()->user()->id)
        ->get();

        return view('chat.index', compact('friends'));
    }
    public function show($id)
    {

        $user = User::find($id);

        if($user)
        {
            $friends = FriendList::query()
            ->where('user', auth()->user()->id)
            ->get();
    
            $messages = Message::query()
            ->where('id', auth()->user()->id*$id)
            ->get();

            return view('chat.show', compact('friends', 'messages', 'user'));
        }
        
        abort(404);
    }
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'text' => ['required', 'string', 'min:5', 'max:1000'],
            'image' => ['nullable', 'image'],
        ]);

        $receiver = $request->input('receiver');

        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('images');
        }

        Message::create([
            'id' => auth()->user()->id*$receiver,
            'sender' => auth()->user()->id,
            'message' => $validated['text'],
            'image' => $path ?? '',
        ]);

        return back();
    }
}
