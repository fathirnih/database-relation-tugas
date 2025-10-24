<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>✏️ Edit Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap & Argon --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-pen"></i> Edit Post</h4>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>

        <div class="card-body">
            {{-- Notifikasi error --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
                </div>

                {{-- Konten --}}
                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="content" rows="5" class="form-control" required>{{ old('content', $post->content) }}</textarea>
                </div>

                {{-- Kategori --}}
                @if(isset($categories) && $categories->count())
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                {{-- Tag --}}
                @if(isset($tags) && $tags->count())
                <div class="mb-3">
                    <label class="form-label">Tag</label>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach($tags as $tag)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="tags[]" 
                                       value="{{ $tag->id }}" 
                                       id="tag{{ $tag->id }}"
                                       {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Gambar --}}
                <div class="mb-3">
                    <label class="form-label">Gambar (opsional)</label>
                    @if($post->image)
                        <div class="mb-2">
                            <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="Gambar Post" class="img-thumbnail rounded shadow-sm" width="150">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success px-4"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
