<?php

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
