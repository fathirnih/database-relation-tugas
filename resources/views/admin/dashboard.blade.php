@extends('layouts.app')

@section('content')
<h1>Dashboard Admin</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<p>Selamat datang, {{ session('admin_name') }} | 
<form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit">Logout</button>
</form>
</p>

<a href="{{ route('admin.posts.create') }}">Buat Post Baru</a>

<table border="1" cellpadding="10" cellspacing="0">
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
                    <img src="{{ asset('uploads/posts/' . $post->image) }}" width="100">
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
@endsection
