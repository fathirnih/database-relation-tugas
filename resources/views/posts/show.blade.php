@extends('layouts.app')

@section('title', $post->title)

@section('content')

<div class="container py-5">
    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary mb-4">← Kembali</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="text-muted">
                Oleh <strong>{{ $post->user->name }}</strong> |
                Kategori: <span class="badge bg-primary">{{ $post->category->name ?? 'Tidak ada' }}</span>
            </p>

            <p class="mt-3">{{ $post->content }}</p>

            <hr>

            <h5>Tags:</h5>
            @forelse ($post->tags as $tag)
                <span class="badge bg-secondary">{{ $tag->name }}</span>
            @empty
                <em>Tidak ada tag</em>
            @endforelse
        </div>
    </div>
</div>
@endsection

