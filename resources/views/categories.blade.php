@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<h2 class="mb-4">Kategori</h2>

<div class="row">
  @foreach($categories as $category)
  <div class="col-md-4 mb-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">{{ $category->name }}</h5>
        <p class="card-text">{{ $category->description ?? 'Tidak ada deskripsi.' }}</p>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
