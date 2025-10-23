@extends('layouts.app')

@section('title', 'Posts')

@section('content')

<div class="container py-4">
    <h1 class="mb-4 text-center">📚 Daftar Post</h1>

    @foreach ($posts as $post)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h4 class="card-title">{{ $post->title }}</h4>
                <p class="text-muted">
                    Oleh <strong>{{ $post->user->name }}</strong> |
                    Kategori: <span class="badge bg-primary">{{ $post->category->name ?? 'Tidak ada' }}</span>
                </p>
                <p>{{ Str::limit($post->content, 100) }}</p>

                <div>
                    <strong>Tags:</strong>
                    @forelse ($post->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @empty
                        <em>Tidak ada tag</em>
                    @endforelse
                </div>

                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary mt-3">Lihat Detail</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
