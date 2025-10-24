@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-primary fw-bold">📚 Daftar Post</h1>

    @forelse ($posts as $post)
        <div class="card mb-4 shadow-sm border-0 rounded-3">
            <div class="row g-0">
                {{-- Kolom gambar (jika ada) --}}
                @if($post->image)
                    <div class="col-md-4">
                        <img src="{{ asset('uploads/posts/' . $post->image) }}" 
                             alt="{{ $post->title }}" 
                             class="img-fluid rounded-start" 
                             style="height: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                @else
                    <div class="col-md-12">
                @endif
                    <div class="card-body">
                        <h4 class="card-title fw-bold text-dark">{{ $post->title }}</h4>
                        <p class="text-muted mb-2">
                            Oleh <strong>{{ $post->user->name }}</strong> |
                            Kategori: 
                            <span class="badge bg-info">{{ $post->category->name ?? 'Tidak ada' }}</span>
                        </p>
                        <p class="card-text">{{ Str::limit($post->content, 120) }}</p>

                        {{-- Tags --}}
                        <div class="mb-2">
                            <strong>Tags:</strong>
                            @forelse ($post->tags as $tag)
                                <span class="badge bg-secondary">{{ $tag->name }}</span>
                            @empty
                                <em class="text-muted">Tidak ada tag</em>
                            @endforelse
                        </div>

                        <a href="{{ route('posts.show', $post->id) }}" 
                           class="btn btn-sm btn-outline-primary mt-2">
                           Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center">
            Belum ada postingan untuk ditampilkan.
        </div>
    @endforelse
</div>
@endsection
