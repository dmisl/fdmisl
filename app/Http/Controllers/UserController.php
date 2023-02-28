<?php

namespace App\Http\Controllers;

use App\Models\FriendList;
use App\Models\Post;
use App\Models\ProfilePost;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    public function index()
    {

        $posts = ProfilePost::query()
        ->where('posted_to', '=', auth()->user()->id)
        ->get();

        if($posts)
        {
            return view('profile.index', compact('posts'));
        }

        return view('profile.index');
    }
    public function show(Request $request, $id)
    {
        $user = User::query()
        ->where('id', $id)
        ->first(['id', 'name']);
        
        if($user)
        {
            $posts = ProfilePost::query()->where('posted_to', '=', $user->id)->get();
            return view('profile.show', compact('user', 'posts'));
        }
        
        return abort(404);
    }
    public function friends(Request $request, $id)
    {
        $user = User::query()
        ->where('id', $id)
        ->first(['id', 'name']);

        if($user)
        {
            return view('profile.friends', compact('user'));
        }

        return abort(404);
    }
    public function avatar(Request $request)
    {
        if($request->file('avatar')){
            // загружаємо наш файл в папку images
            $path = $request->file('avatar')->store('images', 'public');
            // пишемо шо ми обробляємо цю картинку
            $img = Image::make('storage/'.$path);
            // переводимо цю картинку в jpg без втрати якості
            $img->encode('jpg', 100);
            // обрізаємо картинку і робимо її квадратною
            $img->fit(500, 500);
            // зберігаємо оброблену картинку
            $path = 'avatars/avatar-'.auth()->user()->id.'.jpg';
            $img->save('storage/'.$path);
            
            $user = User::query()->where('id', '=', auth()->user()->id)->first();

            $user->avatar = $path;
            $user->save();

            return back();
        }
        return back();
    }
    public function addFriend(Request $request)
    {
        $request_from = $request->input('request_from');
        $request_to = $request->input('request_to');
        $addFriend = $request->input('addFriend');

        $request = ModelsRequest::query()
        ->where('request_from', '=', $addFriend)
        ->where('request_to', '=', auth()->user()->id)
        ->first();

        if($request)
        {
            $request->delete();
            FriendList::create([
                'user' => auth()->user()->id,
                'friend' => $addFriend, 
            ]);
            FriendList::create([
                'user' => $addFriend,
                'friend' => auth()->user()->id, 
            ]);
            return back();
        } else
        {
            ModelsRequest::create([
                'request_from' => $request_from,
                'request_to' => $request_to,
                'type' => '1',
            ]);
            return back();
        }

    }
    public function removeFriend(Request $request)
    {
        $remove = $request->input('remove');

        $request = ModelsRequest::query()
        ->where('request_from', '=', auth()->user()->id)
        ->where('request_to', '=', $remove)
        ->first();
        if($request)
        {
            $request->delete();
            return back();
        }
        else
        {
            FriendList::query()
            ->where('user', '=', auth()->user()->id)
            ->where('friend', '=', $remove)
            ->delete();
            FriendList::query()
            ->where('friend', '=', auth()->user()->id)
            ->where('user', '=', $remove)
            ->delete();

            return back();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
    public function changeUser(Request $request)
    {
        $id = $request->input('id');
        Auth::logout();
        $user = User::query()->where('id', $id)->first();
        Auth::login($user);
    }
}