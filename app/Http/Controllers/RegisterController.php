<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Facade as Avatar;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'name' => ['required', 'string', 'unique:users,name', 'max:50'],
            'password' => ['required', 'string', 'max:200', 'confirmed'],
        ]);
        $request->validate([
            'agreement' => ['accepted'],
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'name' => $validated['name'],
            'password' => bcrypt($validated['password']),
            'status' => '',
        ]);

        Avatar::create($request->name)->save(storage_path('app/public/avatar-'.$user->id.'.png'));

        if($user)
        {
            Auth::login($user);
            return redirect()->route('home.index');
        }


        return redirect()->back()->withInput();
    }
}
