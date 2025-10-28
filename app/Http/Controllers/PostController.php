<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Tampilkan semua post (untuk admin & user)
    public function index()
    {
        $posts = Post::with(['user', 'category', 'tags'])->paginate(5);
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
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.create', compact('categories', 'tags'));
    }

    // Simpan post baru
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'array',
            'tags.*'      => 'exists:tags,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        // Simpan data post
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id ?? null;
        $post->user_id = session('admin_id');

        // Upload gambar
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $post->image = $filename;
        }

        $post->save();

        // Simpan relasi tags ke pivot table
        if ($request->filled('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Post berhasil dibuat.');
    }

    // Form edit post
    public function edit($id)
    {
        $post = Post::with('tags')->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.edit', compact('post', 'categories', 'tags'));
    }

    // Update post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'array',
            'tags.*'      => 'exists:tags,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id ?? null;

        // Update gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image && file_exists(public_path('uploads/posts/' . $post->image))) {
                unlink(public_path('uploads/posts/' . $post->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $post->image = $filename;
        }

        $post->save();

        // Update relasi tag (sync pivot)
        if ($request->filled('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Post berhasil diupdate.');
    }

    // Hapus post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Hapus file gambar jika ada
        if ($post->image && file_exists(public_path('uploads/posts/' . $post->image))) {
            unlink(public_path('uploads/posts/' . $post->image));
        }

        // Hapus relasi tags di pivot
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Post berhasil dihapus.');
    }
}
