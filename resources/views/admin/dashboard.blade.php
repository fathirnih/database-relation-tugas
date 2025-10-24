<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Argon Dashboard CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/argon-dashboard@1.2.2/assets/css/argon-dashboard.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fe; }
        .table th { background-color: #5e72e4; color: white; }
        .card img { max-width: 100px; border-radius: 8px; }
        .btn-logout { background-color: #f5365c; color: white; }
        .btn-logout:hover { background-color: #d9254c; color: white; }
        .badge { font-size: 0.8rem; }
        td p { margin-bottom: 0; }
    </style>
</head>
<body>
<div class="container-fluid py-4">
    <div class="row mb-3">
        <div class="col-md-8">
            <h2 class="text-primary fw-bold">Dashboard Admin</h2>
            <p class="text-muted">Selamat datang, <strong>{{ session('admin_name') }}</strong></p>
        </div>
        <div class="col-md-4 text-end">
            <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-logout btn-sm">Logout</button>
            </form>
        </div>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-dark">Total Postingan: {{ count($posts) }}</h5>
        <div>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success btn-sm">+ Buat Post Baru</a>
            <a href="{{ url('/') }}" class="btn btn-secondary btn-sm">Kembali ke Home</a>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            @if($posts->isEmpty())
                <p class="text-center text-muted my-3">Belum ada postingan.</p>
            @else
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Konten</th>
                            <th>Kategori</th>
                            <th>Tag</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td class="fw-bold">{{ $post->title }}</td>

                            {{-- tampilkan isi konten --}}
                            <td style="max-width: 300px;">
                                <p>{{ Str::limit($post->content, 120) }}</p>
                            </td>

                            {{-- kategori --}}
                            <td>
                                @if($post->category)
                                    <span class="badge bg-info">{{ $post->category->name }}</span>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            {{-- tag --}}
                            <td>
                                @if($post->tags->count())
                                    @foreach($post->tags as $tag)
                                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            {{-- gambar --}}
                            <td>
                                @if($post->image)
                                    <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="{{ $post->title }}" style="width:80px; height:80px; object-fit:cover;">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            {{-- aksi --}}
                            <td>
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- JS Bootstrap + Argon --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/argon-dashboard@1.2.2/assets/js/argon-dashboard.min.js"></script>
</body>
</html>
