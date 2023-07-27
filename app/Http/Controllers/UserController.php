<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        //$posts = Post::where('user_id', auth()->id())->get();
        if (Auth::check()) {
            $posts = auth()->user()->userPosts()->latest()->get();
            return view('home', ['posts' => $posts]);
        }
        return view('home');
    }
    public function register(Request $request)
    {
        $userData = $request->validate([
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8']
        ]);

        $userData['password'] = bcrypt($userData['password']);
        $user = User::create($userData);
        auth()->login($user);
        return redirect('/');
    }

    public function login(Request $request)
    {
        $userData = $request->validate(['loginName' => 'required', 'loginPassword' => 'required']);
        if (auth()->attempt([
            'name' => $userData['loginName'],
            'password' => $userData['loginPassword']
        ])) {
            $request->session()->regenerate();
        }
        return redirect('/');
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
