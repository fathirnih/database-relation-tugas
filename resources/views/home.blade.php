@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="text-center my-5">
    <h1 class="fw-bold mb-3 text-primary">Welcome to King Blog</h1>
    <p class="lead">Tempat berbagi postingan seru seputar Laravel dan dunia teknologi.</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">Lihat Postingan</a>
</div>
@endsection
