<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function addPost(Request $request)
    {
        $postContent = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $postContent['title'] = strip_tags($postContent['title']);
        $postContent['body'] = strip_tags($postContent['body']);
        $postContent['user_id'] = auth()->id();
        Post::create($postContent);
        return redirect('/');
    }
}
