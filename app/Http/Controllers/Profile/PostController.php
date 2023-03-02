<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\ProfilePost;
use App\Models\LikedPost;
use App\Models\SavedPost;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'image'],
        ]);

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
        }

        ProfilePost::query()->create([
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'posted_to' => $request->input('posted_to'),
            'text' => $validated['text'],
            'image' => $path ?? '',
        ]);

        return back();
    }
    public function comment(Request $request)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:1000'],
        ]);

        $post = $request->input('post');
        $content = $validated['content'];

        Comment::create([
            'user' => auth()->user()->id,
            'post' => $post,
            'content' => $content,
        ]);

        return back();
    }
    public function like(Request $request)
    {
        $post = $request->input('post');

        $isLiked = LikedPost::query()
        ->where('user', auth()->user()->id)
        ->where('post', $post)
        ->first();

        if($isLiked)
        {
            $isLiked->delete();
        }
        else {
            LikedPost::create([
                'user' => auth()->user()->id,
                'post' => $post,
            ]);
        }
        return back();
    }
    public function save(Request $request)
    {
        $post = $request->input('post');
        SavedPost::create([
            'user' => auth()->user()->id,
            'post' => $post,
        ]);
        return back();
    }
}
