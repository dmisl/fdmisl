<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\ProfilePost;
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
    public function like(Request $request)
    {
        
    }
}
