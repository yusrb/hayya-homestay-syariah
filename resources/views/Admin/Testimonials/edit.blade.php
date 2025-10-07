@extends('layouts.app_admin')

@section('content')
<div class="bg-white rounded-2xl p-8 shadow-xl">
    <h1 class="text-3xl font-bold text-emerald-600 mb-6">Edit Testimoni</h1>
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-400 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-gray-700 mb-1">Lokasi</label>
            <input type="text" name="location" value="{{ old('location', $testimonial->location) }}" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-400 @error('location') border-red-500 @enderror">
            @error('location')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-gray-700 mb-1">Rating</label>
            <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $testimonial->rating) }}" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-400 @error('rating') border-red-500 @enderror">
            @error('rating')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-gray-700 mb-1">Teks</label>
            <textarea name="text" rows="4" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-400 @error('text') border-red-500 @enderror">{{ old('text', $testimonial->text) }}</textarea>
            @error('text')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-gray-700 mb-1">Gambar</label>
            @if($testimonial->image)
                <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-lg mb-2">
            @endif
            <input type="file" name="image" accept="image/jpeg,image/png" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-400 @error('image') border-red-500 @enderror">
            @error('image')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-gray-700 mb-1">Sumber</label>
            <input type="text" name="source" value="{{ old('source', $testimonial->source) }}" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-400 @error('source') border-red-500 @enderror">
            @error('source')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-gray-700 mb-1">Tanggal</label>
            <input type="date" name="date" value="{{ old('date', $testimonial->date) }}" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-400 @error('date') border-red-500 @enderror">
            @error('date')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg shadow-md transition transform hover:scale-105">
                Update
            </button>
        </div>
    </form>
</div>
@endsection