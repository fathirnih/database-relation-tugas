<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Tampilkan semua post (untuk admin & user)
    public function index()
    {
        $posts = Post::with(['user', 'category', 'tags'])->get();

        if(session()->has('admin_id')){
            return view('admin.dashboard', compact('posts'));
        }

        return view('posts.index', compact('posts'));
    }

    // Tampilkan detail post
    public function show($id)
    {
        $post = Post::with(['user', 'category', 'tags'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // Form buat post baru
    public function create()
    {
        return view('admin.posts.create');
    }

    // Simpan post baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = session('admin_id');

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $post->image = $filename;
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat.');
    }

    // Form edit post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    // Update post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;

        if($request->hasFile('image')){
            // Hapus gambar lama jika ada
            if($post->image && file_exists(public_path('uploads/posts/' . $post->image))){
                unlink(public_path('uploads/posts/' . $post->image));
            }

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $post->image = $filename;
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diupdate.');
    }

    // Hapus post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Hapus file gambar jika ada
        if($post->image && file_exists(public_path('uploads/posts/' . $post->image))){
            unlink(public_path('uploads/posts/' . $post->image));
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus.');
    }
}
