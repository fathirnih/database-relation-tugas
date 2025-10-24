<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label>Judul:</label><br>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        </div>
        <div>
            <label>Konten:</label><br>
            <textarea name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
        </div>
        <div>
            <label>Gambar (opsional):</label><br>
            @if($post->image)
                <img src="{{ asset('uploads/posts/' . $post->image) }}" width="100"><br>
            @endif
            <input type="file" name="image">
        </div>
        <button type="submit">Update</button>
    </form>

    <p><a href="{{ route('admin.posts.index') }}">Kembali ke Daftar Post</a></p>
</body>
</html>
