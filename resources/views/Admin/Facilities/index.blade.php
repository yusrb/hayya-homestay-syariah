@extends('layouts.app_admin')

@section('title', 'Fasilitas')

@section('content')
<div class="max-w-7xl mx-auto">
  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
    <div>
      <h1 class="text-3xl font-semibold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">Daftar Fasilitas</h1>
      <p class="text-neutral-500 mt-2 text-sm">Kelola semua fasilitas yang tersedia di Hayya Syariah</p>
    </div>
    <button onclick="showModal(createForm())" class="mt-4 md:mt-0 bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all flex items-center space-x-2">
      <i class="fa-solid fa-plus"></i>
      <span>Tambah Fasilitas Baru</span>
    </button>
  </div>

  <!-- Table Container -->
  <div class="glass-effect rounded-2xl border border-neutral-200/50 shadow-soft overflow-hidden animate-slide-in">
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white">
            <th class="p-4 text-left font-semibold text-sm">ID</th>
            <th class="p-4 text-left font-semibold text-sm">Nama Fasilitas</th>
            <th class="p-4 text-left font-semibold text-sm">Deskripsi</th>
            <th class="p-4 text-left font-semibold text-sm">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($facilities as $facility)
          <tr class="border-b border-neutral-200/50 even:bg-emerald-50/20 transition-all duration-200 table-row-hover">
            <td class="p-4 font-medium text-emerald-600 text-sm">{{ $facility->id }}</td>
            <td class="p-4">
              <div class="flex items-center">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center mr-3">
                  <i class="{{ $facility->icon ?? 'fa-solid fa-building' }} text-emerald-600"></i>
                </div>
                <span class="font-medium text-neutral-800">{{ $facility->name }}</span>
              </div>
            </td>
            <td class="p-4 text-neutral-600 max-w-md text-sm">{{ Str::limit($facility->description, 80) }}</td>
            <td class="p-4">
              <div class="flex items-center space-x-3">
                <button onclick="showModal(showForm({{ json_encode($facility->toArray()) }}))" class="w-9 h-9 rounded-lg bg-accent-blue/10 flex items-center justify-center text-accent-blue hover:bg-accent-blue/20 transition-all" title="Lihat Detail">
                  <i class="fa-solid fa-eye"></i>
                </button>
                <button onclick="showModal(editForm({{ json_encode($facility->toArray()) }}))" class="w-9 h-9 rounded-lg bg-accent-amber/10 flex items-center justify-center text-accent-amber hover:bg-accent-amber/20 transition-all" title="Edit">
                  <i class="fa-solid fa-pen"></i>
                </button>
                <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST" class="inline">
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
    @if($facilities->hasPages())
    <div class="p-4 border-t border-neutral-200/50 flex items-center justify-between text-sm">
      <div class="text-neutral-600">
        Menampilkan {{ $facilities->firstItem() }} - {{ $facilities->lastItem() }} dari {{ $facilities->total() }} hasil
      </div>
      <div class="flex space-x-2">
        @if($facilities->onFirstPage())
        <span class="px-3 py-1 rounded-lg bg-neutral-100 text-neutral-400">
          <i class="fa-solid fa-chevron-left"></i>
        </span>
        @else
        <a href="{{ $facilities->previousPageUrl() }}" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
          <i class="fa-solid fa-chevron-left"></i>
        </a>
        @endif
        @if($facilities->hasMorePages())
        <a href="{{ $facilities->nextPageUrl() }}" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
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
  @if($facilities->count() == 0)
  <div class="text-center py-16 animate-slide-in">
    <div class="w-24 h-24 mx-auto rounded-full bg-emerald-50 flex items-center justify-center mb-6">
      <i class="fa-solid fa-building text-emerald-500 text-4xl"></i>
    </div>
    <h3 class="text-xl font-semibold text-neutral-700 mb-2">Belum ada fasilitas</h3>
    <p class="text-neutral-500 mb-6 text-sm">Tambahkan fasilitas pertama Anda untuk mulai mengelolanya</p>
    <button onclick="showModal(createForm())" class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all inline-flex items-center space-x-2">
      <i class="fa-solid fa-plus"></i>
      <span>Tambah Fasilitas</span>
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
      text: "Fasilitas yang dihapus tidak dapat dikembalikan!",
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
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Tambah Fasilitas</h1>
        <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Nama</label>
            <input type="text" name="name" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="4" required></textarea>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Icon (opsional)</label>
            <input type="text" name="icon" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" placeholder="Contoh: fa-solid fa-wifi">
            <p class="text-xs text-neutral-500 mt-1">Masukkan kelas Font Awesome untuk icon (misal: fa-solid fa-wifi).</p>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Gambar (maks. 5)</label>
            <input type="file" name="images[]" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" accept="image/jpeg,image/png" multiple>
            <p class="text-xs text-neutral-500 mt-1">Gambar pertama akan menjadi gambar utama.</p>
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
  function editForm(facility) {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Edit Fasilitas</h1>
        <form action="/admin/facilities/${facility.id}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Nama</label>
            <input type="text" name="name" value="${facility.name}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="4" required>${facility.description}</textarea>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Icon (opsional)</label>
            <input type="text" name="icon" value="${facility.icon || ''}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" placeholder="Contoh: fa-solid fa-wifi">
            <p class="text-xs text-neutral-500 mt-1">Masukkan kelas Font Awesome untuk icon (misal: fa-solid fa-wifi).</p>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Gambar Baru (maks. 5)</label>
            <input type="file" name="images[]" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" accept="image/jpeg,image/png" multiple>
            <p class="text-xs text-neutral-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
            <div class="mt-3">
              <p class="text-sm text-neutral-700 mb-2">Gambar saat ini:</p>
              <div class="grid grid-cols-2 gap-4">
                ${facility.facility_images && facility.facility_images.length > 0 ? facility.facility_images.map(image => `
                  <div class="relative">
                    <img src="/storage/${image.file_path}" class="w-full h-32 object-cover rounded-lg">
                    ${image.is_primary ? '<span class="absolute top-2 left-2 bg-emerald-500 text-white px-2 py-1 rounded text-xs">Utama</span>' : ''}
                  </div>
                `).join('') : '<p class="text-neutral-500 text-sm">Tidak ada gambar.</p>'}
              </div>
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
  function showForm(facility) {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Detail Fasilitas</h1>
        <div class="space-y-4">
          <p class="text-sm"><strong class="text-neutral-700">Nama:</strong> ${facility.name}</p>
          <p class="text-sm"><strong class="text-neutral-700">Deskripsi:</strong> ${facility.description}</p>
          <p class="text-sm"><strong class="text-neutral-700">Icon:</strong> ${facility.icon || 'Tidak ada'}</p>
          <p class="text-sm"><strong class="text-neutral-700">Gambar:</strong></p>
          <div class="grid grid-cols-2 gap-4">
            ${facility.facility_images && facility.facility_images.length > 0 ? facility.facility_images.map(image => `
              <div class="relative">
                <img src="/storage/${image.file_path}" class="w-full h-32 object-cover rounded-lg">
                ${image.is_primary ? '<span class="absolute top-2 left-2 bg-emerald-500 text-white px-2 py-1 rounded text-xs">Utama</span>' : ''}
              </div>
            `).join('') : '<p class="text-neutral-500 text-sm">Tidak ada gambar.</p>'}
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