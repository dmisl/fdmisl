<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'string', 'max:100'],
            'password' => ['required', 'string', 'max:200'],
            'remember' => ['nullable', 'boolean'],
        ]);


        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $validated['remember'] ?? false)) {
            alert('Ласкаво просимо');
            return redirect()->route('home.index');
        } else {
            alert('Данні не сходяться');
            return back()->withInput();
        }
    }
}
