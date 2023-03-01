<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
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
