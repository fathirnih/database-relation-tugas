@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container py-5">

    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary mb-4">
        ← Kembali ke Daftar Post
    </a>

    <div class="card shadow-lg border-0 rounded-3">
        {{-- Gambar Post --}}
        @if($post->image)
            <img src="{{ asset('uploads/posts/' . $post->image) }}" 
                 alt="{{ $post->title }}" 
                 class="card-img-top" 
                 style="max-height: 400px; object-fit: cover;">
        @endif

        <div class="card-body">
            <h2 class="card-title text-primary fw-bold">{{ $post->title }}</h2>
            
            <p class="text-muted mb-3">
                Oleh <strong>{{ $post->user->name }}</strong> | 
                Kategori: 
                <span class="badge bg-info">{{ $post->category->name ?? 'Tidak ada' }}</span>
            </p>

            <p class="card-text fs-5" style="white-space: pre-line;">
                {{ $post->content }}
            </p>

            <hr class="my-4">

            <h5 class="fw-semibold mb-2">Tags:</h5>
            @forelse ($post->tags as $tag)
                <span class="badge bg-secondary me-1 mb-1">{{ $tag->name }}</span>
            @empty
                <em class="text-muted">Tidak ada tag</em>
            @endforelse
        </div>
    </div>

</div>
@endsection
