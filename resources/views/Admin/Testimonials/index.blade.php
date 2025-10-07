@extends('layouts.app_admin')

@section('content')
<div class="bg-white rounded-2xl p-8 shadow-xl">
    <h1 class="text-3xl font-bold text-emerald-600 mb-6">Daftar Testimoni</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg mb-4 inline-block">Tambah Testimoni</a>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-emerald-100">
                <th class="p-2">ID</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Lokasi</th>
                <th class="p-2">Rating</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $testimonial)
            <tr class="border-b">
                <td class="p-2">{{ $testimonial->id }}</td>
                <td class="p-2">{{ $testimonial->name }}</td>
                <td class="p-2">{{ $testimonial->location }}</td>
                <td class="p-2">{{ $testimonial->rating }}</td>
                <td class="p-2">
                    <a href="{{ route('admin.testimonials.show', $testimonial) }}" class="text-blue-600">Lihat</a>
                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-yellow-600 mx-2">Edit</a>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection