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
        body {
            background-color: #f8f9fe;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border: none;
            border-radius: 1rem;
        }
        .table th {
            background-color: #5e72e4;
            color: white;
            text-transform: uppercase;
            font-size: 0.85rem;
        }
        .table td {
            vertical-align: middle;
        }
        .btn-logout {
            background-color: #f5365c;
            color: white;
        }
        .btn-logout:hover {
            background-color: #d9254c;
        }
        .badge {
            font-size: 0.8rem;
            margin-right: 2px;
        }
        .content-wrapper {
            max-width: 1200px;
            margin: auto;
        }
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
        .pagination .page-link {
            color: #5e72e4;
        }
        .pagination .active .page-link {
            background-color: #5e72e4;
            border-color: #5e72e4;
        }
    </style>
</head>

<body>
<div class="container-fluid py-4 content-wrapper">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-primary fw-bold mb-1">Dashboard Admin</h2>
            <p class="text-muted mb-0">Selamat datang, <strong>{{ session('admin_name') }}</strong></p>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-logout btn-sm px-3">Logout</button>
        </form>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    {{-- Info --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold text-dark mb-0">Total Postingan: {{ $totalPosts }}</h5>
        <div>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success btn-sm px-3">+ Buat Post Baru</a>
            <a href="{{ url('/') }}" class="btn btn-secondary btn-sm px-3">Kembali ke Home</a>
        </div>
    </div>

    {{-- Card Table --}}
    <div class="card shadow-lg">
        <div class="card-body">
            @if($posts->isEmpty())
                <p class="text-center text-muted my-3">Belum ada postingan.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-items-center mb-0">
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
                                    <td class="fw-bold text-primary">{{ $post->title }}</td>

                                    {{-- Konten --}}
                                    <td style="max-width: 300px;">
                                        <p class="text-muted small">{{ Str::limit($post->content, 120) }}</p>
                                    </td>

                                    {{-- Kategori --}}
                                    <td>
                                        @if($post->category)
                                            <span class="badge bg-info">{{ $post->category->name }}</span>
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>

                                    {{-- Tag --}}
                                    <td>
                                        @if($post->tags->count())
                                            @foreach($post->tags as $tag)
                                                <span class="badge bg-secondary">{{ $tag->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>

                                    {{-- Gambar --}}
                                    <td>
                                        @if($post->image)
                                            <img src="{{ asset('uploads/posts/' . $post->image) }}"
                                                 alt="{{ $post->title }}"
                                                 class="rounded shadow-sm"
                                                 style="width:80px; height:80px; object-fit:cover;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td>
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin mau hapus?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $posts->links('pagination::bootstrap-5') }}
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
