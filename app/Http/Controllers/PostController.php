<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Ambil semua post beserta relasi
        $posts = Post::with(['user', 'category', 'tags'])->get();
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with(['user', 'category', 'tags'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
