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
    public function showPost(Post $post)
    {
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/');
        }
        return view('post', ['post' => $post]);
    }

    public function editPost(Post $post, Request $request)
    {
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/');
        }
        $postContent = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $postContent['title'] = strip_tags($postContent['title']);
        $postContent['body'] = strip_tags($postContent['body']);

        $post->update($postContent);
        return redirect('/');
    }

    public function deletePost(Post $post)
    {
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/');
        }
        $post->delete();
        return redirect('/');
    }
}
