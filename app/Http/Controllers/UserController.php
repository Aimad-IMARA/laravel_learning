<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        //$posts = Post::where('user_id', auth()->id())->get();
        $posts = auth()->user()->user_posts()->latest()->get();
        return view('home', ['posts' => $posts]);
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
