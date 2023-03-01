<?php

use App\Models\FriendList;
use App\Models\Request;
use App\Models\User;

if(!function_exists('alert'))
{
    function alert(string $value)
    {
        session(['alert' => $value]);
    }
}

if(!function_exists('avatar'))
{
    function avatar($id)
    {
        $user = User::query()->where('id', '=', $id)->first();
        if($user->avatar)
        {
            
            return asset("/storage/avatars/avatar-".$user->id.".jpg");
        }
        return asset('/storage/avatar-'.$user->id.'.png');
    }
}

if(!function_exists('friendRequest'))
{
    function friendRequest($id)
    {
        $isset = Request::query()
        ->where('request_from', '=', auth()->user()->id)
        ->where('request_to', '=', $id)
        ->first();
        if($isset)
        {
            return true;
        }
        return false;
    }
}

if(!function_exists('acceptRequests'))
{
    function acceptRequests()
    {
        $requests = Request::query()
        ->get();
        echo '<pre>';
        foreach ($requests as $request) {
            var_dump($request);
            FriendList::create([
                'user' => $request['request_from'],
                'friend' => $request['request_to'],
            ]);
            FriendList::create([
                'user' => $request['request_to'],
                'friend' => $request['request_from'],
            ]);
            $request->delete();
        }
        
    }
}

if(!function_exists('name'))
{
    function name($id)
    {
        $user = User::query()
        ->where('id', $id)
        ->first('name');
        return $user->name;
    }
}