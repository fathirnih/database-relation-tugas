<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buat Post Baru</title>
</head>
<body>
    <h1>Buat Post Baru</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Judul:</label><br>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>
        <div>
            <label>Konten:</label><br>
            <textarea name="content" rows="5" required>{{ old('content') }}</textarea>
        </div>
        <div>
            <label>Gambar (opsional):</label><br>
            <input type="file" name="image">
        </div>
        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('admin.posts.index') }}">Kembali ke Daftar Post</a></p>
</body>
</html>
