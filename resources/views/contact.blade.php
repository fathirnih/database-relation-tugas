@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="text-center my-5">
  <h2 class="fw-bold text-primary mb-4">Hubungi Kami</h2>
  <p class="mb-3">Punya pertanyaan, saran, atau ingin bekerja sama? Kirimkan pesan kamu melalui form di bawah ini!</p>

  <form class="mx-auto" style="max-width: 500px;">
    <div class="mb-3 text-start">
      <label class="form-label">Nama</label>
      <input type="text" class="form-control" placeholder="Masukkan nama kamu">
    </div>

    <div class="mb-3 text-start">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" placeholder="Masukkan email kamu">
    </div>

    <div class="mb-3 text-start">
      <label class="form-label">Pesan</label>
      <textarea class="form-control" rows="4" placeholder="Tulis pesan kamu di sini..."></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
  </form>
</div>
@endsection
