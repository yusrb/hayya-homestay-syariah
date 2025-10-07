@extends('layouts.app_admin')

@section('content')
<div class="bg-white rounded-2xl p-8 shadow-xl">
    <h1 class="text-3xl font-bold text-emerald-600 mb-6">Detail Testimoni</h1>
    <p><strong>Nama:</strong> {{ $testimonial->name }}</p>
    <p><strong>Lokasi:</strong> {{ $testimonial->location }}</p>
    <p><strong>Rating:</strong> {{ $testimonial->rating }}</p>
    <p><strong>Teks:</strong> {{ $testimonial->text }}</p>
    <p><strong>Image URL:</strong> {{ $testimonial->image_url }}</p>
    <p><strong>Sumber:</strong> {{ $testimonial->source }}</p>
    <p><strong>Tanggal:</strong> {{ $testimonial->date }}</p>
    <a href="{{ route('admin.testimonials.index') }}" class="text-emerald-600">Kembali</a>
</div>
@endsection