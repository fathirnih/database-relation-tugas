<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Post Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">✏️ Buat Post Baru</h4>
        </div>

        <div class="card-body">
            {{-- Pesan error --}}
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
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" required placeholder="Masukkan judul post">
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="content" rows="5" class="form-control" required placeholder="Tulis isi post...">{{ old('content') }}</textarea>
                </div>

                {{-- Pilihan kategori --}}
                @if(isset($categories) && $categories->count())
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                {{-- Pilihan tag --}}
                @if(isset($tags) && $tags->count())
                <div class="mb-3">
                    <label class="form-label">Tag</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}">
                                <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Gambar (opsional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
