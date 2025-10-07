@extends('layouts.app_admin')

@section('title', 'Item Galeri')

@section('content')
<div class="max-w-7xl mx-auto">
  @if ($errors->any())
    <div class="text-red-500 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
    <div>
      <h1 class="text-3xl font-semibold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">Daftar Item Galeri</h1>
      <p class="text-neutral-500 mt-2 text-sm">Kelola foto dan video galeri Hayya Syariah</p>
    </div>
    <button onclick="showModal(createForm())" class="mt-4 md:mt-0 bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all flex items-center space-x-2">
      <i class="fa-solid fa-plus"></i>
      <span>Tambah Item Galeri</span>
    </button>
  </div>

  <!-- Table Container -->
  <div class="glass-effect rounded-2xl border border-neutral-200/50 shadow-soft overflow-hidden animate-slide-in">
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white">
            <th class="p-4 text-left font-semibold text-sm">Pratinjau</th>
            <th class="p-4 text-left font-semibold text-sm">ID</th>
            <th class="p-4 text-left font-semibold text-sm">Tipe</th>
            <th class="p-4 text-left font-semibold text-sm">Judul</th>
            <th class="p-4 text-left font-semibold text-sm">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($galleryItems as $galleryItem)
          <tr class="border-b border-neutral-200/50 even:bg-emerald-50/20 transition-all duration-200 table-row-hover">
            <td class="p-4">
              <div class="flex items-center justify-center">
                @if($galleryItem->type == 'foto')
                <img src="{{ asset('storage/' . $galleryItem->file_path) }}" alt="{{ $galleryItem->title }}" class="w-20 h-20 object-cover rounded-lg">
                @else
                <video class="w-16 h-16 object-cover rounded-lg" controls>
                  <source src="{{ asset('storage/' . $galleryItem->file_path) }}" type="video/mp4">
                </video>
                @endif
              </div>
            </td>
            <td class="p-4 font-medium text-emerald-600 text-sm">{{ $galleryItem->id }}</td>
            <td class="p-4 text-neutral-600 text-sm">{{ ucfirst($galleryItem->type) }}</td>
            <td class="p-4 text-neutral-600 text-sm">{{ Str::limit($galleryItem->title, 50) }}</td>
            <td class="p-4">
              <div class="flex items-center space-x-3">
                <button onclick="showModal(showForm({{ json_encode($galleryItem->toArray()) }}))" class="w-9 h-9 rounded-lg bg-accent-blue/10 flex items-center justify-center text-accent-blue hover:bg-accent-blue/20 transition-all" title="Lihat Detail">
                  <i class="fa-solid fa-eye"></i>
                </button>
                <button onclick="showModal(editForm({{ json_encode($galleryItem->toArray()) }}))" class="w-9 h-9 rounded-lg bg-accent-amber/10 flex items-center justify-center text-accent-amber hover:bg-accent-amber/20 transition-all" title="Edit">
                  <i class="fa-solid fa-pen"></i>
                </button>
                <form action="{{ route('admin.gallery_items.destroy', $galleryItem) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="w-9 h-9 rounded-lg bg-accent-red/10 flex items-center justify-center text-accent-red hover:bg-accent-red/20 transition-all" title="Hapus" onclick="return confirmDelete(event)">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
    <!-- Pagination -->
    @if($galleryItems->hasPages())
    <div class="p-4 border-t border-neutral-200/50 flex items-center justify-between text-sm">
      <div class="text-neutral-600">
        Menampilkan {{ $galleryItems->firstItem() }} - {{ $galleryItems->lastItem() }} dari {{ $galleryItems->total() }} hasil
      </div>
      <div class="flex space-x-2">
        @if($galleryItems->onFirstPage())
        <span class="px-3 py-1 rounded-lg bg-neutral-100 text-neutral-400">
          <i class="fa-solid fa-chevron-left"></i>
        </span>
        @else
        <a href="{{ $galleryItems->previousPageUrl() }}" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
          <i class="fa-solid fa-chevron-left"></i>
        </a>
        @endif
        @if($galleryItems->hasMorePages())
        <a href="{{ $galleryItems->nextPageUrl() }}" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
          <i class="fa-solid fa-chevron-right"></i>
        </a>
        @else
        <span class="px-3 py-1 rounded-lg bg-neutral-100 text-neutral-400">
          <i class="fa-solid fa-chevron-right"></i>
        </span>
        @endif
      </div>
    </div>
    @endif
  </div>

  <!-- Empty State -->
  @if($galleryItems->count() == 0)
  <div class="text-center py-16 animate-slide-in">
    <div class="w-24 h-24 mx-auto rounded-full bg-emerald-50 flex items-center justify-center mb-6">
      <i class="fa-solid fa-image text-emerald-500 text-4xl"></i>
    </div>
    <h3 class="text-xl font-semibold text-neutral-700 mb-2">Belum ada item galeri</h3>
    <p class="text-neutral-500 mb-6 text-sm">Tambahkan foto atau video untuk galeri Anda</p>
    <button onclick="showModal(createForm())" class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all inline-flex items-center space-x-2">
      <i class="fa-solid fa-plus"></i>
      <span>Tambah Item Galeri</span>
    </button>
  </div>
  @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Konfirmasi penghapusan
  function confirmDelete(event) {
    event.preventDefault();
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Item galeri yang dihapus tidak dapat dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#14b8a6',
      cancelButtonColor: '#ef4444',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        event.target.closest('form').submit();
      }
    });
    return false;
  }

  // Create Form Modal
  function createForm() {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Tambah Item Galeri</h1>
        <form action="{{ route('admin.gallery_items.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Tipe</label>
            <select name="type" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
              <option value="foto">Foto</option>
              <option value="video">Video</option>
            </select>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Judul</label>
            <input type="text" name="title" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Deskripsi (opsional)</label>
            <textarea name="description" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="4"></textarea>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">File (Foto/Video)</label>
            <input type="file" name="file" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" accept="image/jpeg,image/png,video/mp4" required>
            <p class="text-xs text-neutral-500 mt-1">Maks. 10MB, format: JPG, PNG (foto) atau MP4 (video).</p>
          </div>
          <div class="flex justify-end space-x-3">
            <button type="button" onclick="closeModal()" class="bg-neutral-100 text-neutral-600 px-4 py-2 rounded-lg text-sm hover:bg-neutral-200 transition-colors">Batal</button>
            <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-600 transition-colors">Simpan</button>
          </div>
        </form>
      </div>
    `;
  }

  // Edit Form Modal
  function editForm(galleryItem) {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Edit Item Galeri</h1>
        <form action="/admin/gallery_items/${galleryItem.id}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Tipe</label>
            <select name="type" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
              <option value="foto" ${galleryItem.type === 'foto' ? 'selected' : ''}>Foto</option>
              <option value="video" ${galleryItem.type === 'video' ? 'selected' : ''}>Video</option>
            </select>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Judul</label>
            <input type="text" name="title" value="${galleryItem.title.replace(/"/g, '&quot;')}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Deskripsi (opsional)</label>
            <textarea name="description" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="4">${galleryItem.description ? galleryItem.description.replace(/</g, '&lt;').replace(/>/g, '&gt;') : ''}</textarea>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">File Baru (opsional)</label>
            <input type="file" name="file" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" accept="image/jpeg,image/png,video/mp4">
            <p class="text-xs text-neutral-500 mt-1">Maks. 10MB, format: JPG, PNG (foto) atau MP4 (video). Biarkan kosong jika tidak ingin mengganti file.</p>
            <div class="mt-3">
              <p class="text-sm text-neutral-700 mb-2">File saat ini:</p>
              ${galleryItem.type === 'foto' ? `
                <img src="/storage/${galleryItem.file_path}" class="w-32 h-32 object-cover rounded-lg">
              ` : `
                <video class="w-32 h-32 object-cover rounded-lg" controls>
                  <source src="/storage/${galleryItem.file_path}" type="video/mp4">
                </video>
              `}
            </div>
          </div>
          <div class="flex justify-end space-x-3">
            <button type="button" onclick="closeModal()" class="bg-neutral-100 text-neutral-600 px-4 py-2 rounded-lg text-sm hover:bg-neutral-200 transition-colors">Batal</button>
            <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-600 transition-colors">Update</button>
          </div>
        </form>
      </div>
    `;
  }

  // Show Form Modal
  function showForm(galleryItem) {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Detail Item Galeri</h1>
        <div class="space-y-4">
          <div class="bg-emerald-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Tipe:</p>
            <p class="text-sm text-neutral-800">${galleryItem.type.charAt(0).toUpperCase() + galleryItem.type.slice(1)}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Judul:</p>
            <p class="text-sm text-neutral-800">${galleryItem.title.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Deskripsi:</p>
            <p class="text-sm text-neutral-800">${galleryItem.description ? galleryItem.description.replace(/</g, '&lt;').replace(/>/g, '&gt;') : 'Tidak ada'}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-2">File:</p>
            ${galleryItem.type === 'foto' ? `
              <img src="/storage/${galleryItem.file_path}" class="w-full max-w-md h-auto object-cover rounded-lg">
            ` : `
              <video class="w-full max-w-md h-auto object-cover rounded-lg" controls>
                <source src="/storage/${galleryItem.file_path}" type="video/mp4">
              </video>
            `}
          </div>
        </div>
        <div class="flex justify-end mt-6">
          <button onclick="closeModal()" class="bg-neutral-100 text-neutral-600 px-4 py-2 rounded-lg text-sm hover:bg-neutral-200 transition-colors">Tutup</button>
        </div>
      </div>
    `;
  }
</script>
@endsection