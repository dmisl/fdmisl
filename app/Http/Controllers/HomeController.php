<?php

namespace App\Http\Controllers;

use App\Models\FriendList;
use App\Models\ProfilePost;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $friends = FriendList::query()->select('friend')->where('user', auth()->user()->id);

        $requests = ModelsRequest::query()->select('request_to')->where('request_from', auth()->user()->id);

        $posts = ProfilePost::query()->whereIn('user_id', $friends)->get();

        $recommend = User::query()
        ->whereNotIn('id', $friends)
        ->whereNotIn('id', $requests)
        ->where('id', '!=', auth()->user()->id)
        ->first();

        return view('home.index', compact('posts', 'recommend'));
    }


    public function autocomplete(Request $request)
    {
        $search = $request->input('search');
        $data = User::query()
        ->where('name', 'like', "%{$search}%")
        ->get();

        return response()->json($data);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $user = User::query()
        ->where('name', $search)
        ->first();

        if($user)
        {
            return redirect()->route('profile.show', $user->id);
        }
        
        return back()->withInput();
    }
}
