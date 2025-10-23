<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Relasi Database - Laravel</title>
</head>
<body>

    <h1>1️⃣ Jumlah Posts per User</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Nama User</th>
            <th>Jumlah Post</th>
        </tr>
        @foreach ($postsPerUser as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->posts_count }}</td>
            </tr>
        @endforeach
    </table>

    <hr>

    <h1>2️⃣ Posts dengan Tag: {{ $tag ? $tag->name : 'Tag tidak ditemukan' }}</h1>
    @if ($postsWithTag->isNotEmpty())
        <ul>
            @foreach ($postsWithTag as $postTag)
                <li>{{ $postTag->title }}</li>
            @endforeach
        </ul>
    @else
        <p>Tidak ada post dengan tag ini.</p>
    @endif

    <hr>

    <h1>3️⃣ Detail Lengkap 1 Post</h1>
    @if ($post)
        <p><strong>Judul:</strong> {{ $post->title }}</p>
        <p><strong>Isi:</strong> {{ $post->content }}</p>
        <p><strong>Penulis:</strong> {{ $post->user->name }}</p>
        <p><strong>Tags:</strong>
            @foreach ($post->tags as $tag)
                {{ $tag->name }}@if(!$loop->last),@endif
            @endforeach
        </p>
    @else
        <p>Tidak ada post ditemukan.</p>
    @endif

</body>
</html>
