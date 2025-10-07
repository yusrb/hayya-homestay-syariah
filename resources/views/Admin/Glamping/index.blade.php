@extends('layouts.app_admin')

@section('title', 'Daftar Glamping')

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
            <h1 class="text-3xl font-semibold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">Daftar Glamping</h1>
            <p class="text-neutral-500 mt-2 text-sm">Kelola glamping Hayya Syariah</p>
        </div>
        <button onclick="showModal(createForm())" class="mt-4 md:mt-0 bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all flex items-center space-x-2">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Glamping</span>
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
                        <th class="p-4 text-left font-semibold text-sm">Status</th>
                        <th class="p-4 text-left font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($glampings as $glamping)
                    <tr class="border-b border-neutral-200/50 even:bg-emerald-50/20 transition-all duration-200 table-row-hover">
                        <td class="p-4">
                            <div class="flex items-center justify-center">
                                @if($glamping->images->count() > 0)
                                <img src="{{ asset('storage/' . $glamping->images->first()->image_path) }}" alt="{{ $glamping->title }}" class="w-20 h-20 object-cover rounded-lg">
                                @else
                                <div class="w-20 h-20 bg-neutral-100 rounded-lg flex items-center justify-center">
                                    <i class="fa-solid fa-tent text-neutral-400"></i>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="p-4 font-medium text-emerald-600 text-sm">{{ $glamping->id }}</td>
                        <td class="p-4 text-neutral-600 text-sm">{{ ucfirst($glamping->type) }}</td>
                        <td class="p-4 text-neutral-600 text-sm">{{ Str::limit($glamping->title, 50) }}</td>
                        <td class="p-4">
                            <span class="{{ $glamping->status == 'available' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }} px-3 py-1 rounded-full text-sm font-medium">
                                {{ ucfirst($glamping->status) }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center space-x-3">
                                <button onclick="showModal(showForm({{ json_encode($glamping->toArray()) }}))" class="w-9 h-9 rounded-lg bg-accent-blue/10 flex items-center justify-center text-accent-blue hover:bg-accent-blue/20 transition-all" title="Lihat Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button onclick="showModal(editForm({{ json_encode($glamping->toArray()) }}))" class="w-9 h-9 rounded-lg bg-accent-amber/10 flex items-center justify-center text-accent-amber hover:bg-accent-amber/20 transition-all" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <form action="{{ route('admin.glampings.destroy', $glamping) }}" method="POST" class="inline">
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
        @if($glampings->hasPages())
        <div class="p-4 border-t border-neutral-200/50 flex items-center justify-between text-sm">
            <div class="text-neutral-600">
                Menampilkan {{ $glampings->firstItem() }} - {{ $glampings->lastItem() }} dari {{ $glampings->total() }} hasil
            </div>
            <div class="flex space-x-2">
                @if($glampings->onFirstPage())
                <span class="px-3 py-1 rounded-lg bg-neutral-100 text-neutral-400">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>
                @else
                <a href="{{ $glampings->previousPageUrl() }}" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
                @endif
                @if($glampings->hasMorePages())
                <a href="{{ $glampings->nextPageUrl() }}" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
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
    @if($glampings->count() == 0)
    <div class="text-center py-16 animate-slide-in">
        <div class="w-24 h-24 mx-auto rounded-full bg-emerald-50 flex items-center justify-center mb-6">
            <i class="fa-solid fa-tent text-emerald-500 text-4xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-neutral-700 mb-2">Belum ada glamping</h3>
        <p class="text-neutral-500 mb-6 text-sm">Tambahkan glamping untuk Hayya Syariah</p>
        <button onclick="showModal(createForm())" class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all inline-flex items-center space-x-2">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Glamping</span>
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
      text: "Item glamping yang dihapus tidak dapat dikembalikan!",
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
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Tambah Glamping</h1>
        <form action="{{ route('admin.glampings.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Tipe</label>
            <select name="type" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
              <option value="standard">Standard</option>
              <option value="deluxe">Deluxe</option>
              <option value="family">Family</option>
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
            <label class="block text-neutral-700 font-medium text-sm mb-1">Status</label>
            <select name="status" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
              <option value="available">Tersedia</option>
              <option value="unavailable">Tidak Tersedia</option>
            </select>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Kapasitas</label>
            <input type="number" name="capacity" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" min="1" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Tempat Tidur</label>
            <input type="number" name="beds" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" min="1" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Harga (Rp)</label>
            <input type="number" name="price" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" min="0" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Rating (0-5)</label>
            <input type="number" name="rating" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" min="0" max="5" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Gambar (banyak, maks 10MB masing-masing)</label>
            <input type="file" name="images[]" multiple class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" accept="image/jpeg,image/png" required>
            <p class="text-xs text-neutral-500 mt-1">Format: JPG, PNG.</p>
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
  function editForm(glamping) {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Edit Glamping</h1>
        <form action="/admin/glampings/${glamping.id}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Tipe</label>
            <select name="type" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
              <option value="standard" ${glamping.type === 'standard' ? 'selected' : ''}>Standard</option>
              <option value="deluxe" ${glamping.type === 'deluxe' ? 'selected' : ''}>Deluxe</option>
              <option value="family" ${glamping.type === 'family' ? 'selected' : ''}>Family</option>
            </select>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Judul</label>
            <input type="text" name="title" value="${glamping.title.replace(/"/g, '&quot;')}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Deskripsi (opsional)</label>
            <textarea name="description" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="4">${glamping.description ? glamping.description.replace(/</g, '&lt;').replace(/>/g, '&gt;') : ''}</textarea>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Status</label>
            <select name="status" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
              <option value="available" ${glamping.status === 'available' ? 'selected' : ''}>Tersedia</option>
              <option value="unavailable" ${glamping.status === 'unavailable' ? 'selected' : ''}>Tidak Tersedia</option>
            </select>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Kapasitas</label>
            <input type="number" name="capacity" value="${glamping.capacity}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" min="1" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Tempat Tidur</label>
            <input type="number" name="beds" value="${glamping.beds}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" min="1" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Harga (Rp)</label>
            <input type="number" name="price" value="${glamping.price}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" min="0" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Rating (0-5)</label>
            <input type="number" name="rating" value="${glamping.rating}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" min="0" max="5" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Gambar Baru (opsional, tambah banyak)</label>
            <input type="file" name="images[]" multiple class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" accept="image/jpeg,image/png">
            <p class="text-xs text-neutral-500 mt-1">Format: JPG, PNG. Maks 10MB masing-masing.</p>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Gambar Saat Ini</label>
            <div class="grid grid-cols-3 gap-4">
              ${glamping.images && glamping.images.length > 0 ? 
                glamping.images.map(img => `
                  <div class="relative">
                    <img src="/storage/${img.image_path}" class="w-full h-32 object-cover rounded-lg">
                    <form action="/admin/glampings/images/${img.id}" method="POST" class="absolute top-2 right-2">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-full text-xs" onclick="return confirm('Yakin hapus gambar?')">Hapus</button>
                    </form>
                  </div>
                `).join('') : 
                '<p class="text-neutral-500">Tidak ada gambar.</p>'
              }
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
  function showForm(glamping) {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Detail Glamping</h1>
        <div class="space-y-4">
          <div class="bg-emerald-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Tipe:</p>
            <p class="text-sm text-neutral-800">${glamping.type.charAt(0).toUpperCase() + glamping.type.slice(1)}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Judul:</p>
            <p class="text-sm text-neutral-800">${glamping.title.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Deskripsi:</p>
            <p class="text-sm text-neutral-800">${glamping.description ? glamping.description.replace(/</g, '&lt;').replace(/>/g, '&gt;') : 'Tidak ada'}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Status:</p>
            <p class="text-sm text-neutral-800">${glamping.status.charAt(0).toUpperCase() + glamping.status.slice(1)}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Kapasitas:</p>
            <p class="text-sm text-neutral-800">${glamping.capacity}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Tempat Tidur:</p>
            <p class="text-sm text-neutral-800">${glamping.beds}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Harga:</p>
            <p class="text-sm text-neutral-800">Rp ${new Intl.NumberFormat('id-ID').format(glamping.price)}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Rating:</p>
            <p class="text-sm text-neutral-800">${glamping.rating}/5</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-2">Gambar:</p>
            <div class="grid grid-cols-3 gap-4">
              ${glamping.images && glamping.images.length > 0 ? 
                glamping.images.map(img => `
                  <img src="/storage/${img.image_path}" class="w-full h-32 object-cover rounded-lg">
                `).join('') : 
                '<p class="text-neutral-500">Tidak ada gambar.</p>'
              }
            </div>
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