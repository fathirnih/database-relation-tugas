<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        img { max-width: 100px; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>Dashboard Admin</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <p>
        Selamat datang, {{ session('admin_name') }} | 
        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </p>

    <a href="{{ route('admin.posts.create') }}">Buat Post Baru</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>
                    @if($post->image)
                        <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="{{ $post->title }}">
                    @else
                        Tidak ada
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
