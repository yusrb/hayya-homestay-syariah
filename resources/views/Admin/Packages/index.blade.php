@extends('layouts.app_admin')

@section('title', 'Paket')

@section('content')
<div class="max-w-7xl mx-auto">
  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
    <div>
      <h1 class="text-3xl font-semibold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">Daftar Paket</h1>
      <p class="text-neutral-500 mt-2 text-sm">Kelola paket layanan di Hayya Syariah</p>
    </div>
    <button onclick="showModal(createForm())" class="mt-4 md:mt-0 bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all flex items-center space-x-2">
      <i class="fa-solid fa-plus"></i>
      <span>Tambah Paket</span>
    </button>
  </div>

  <!-- Table Container -->
  <div class="glass-effect rounded-2xl border border-neutral-200/50 shadow-soft overflow-hidden animate-slide-in">
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white">
            <th class="p-4 text-left font-semibold text-sm">ID</th>
            <th class="p-4 text-left font-semibold text-sm">Nama</th>
            <th class="p-4 text-left font-semibold text-sm">Harga</th>
            <th class="p-4 text-left font-semibold text-sm">Durasi</th>
            <th class="p-4 text-left font-semibold text-sm">Populer</th>
            <th class="p-4 text-left font-semibold text-sm">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($packages as $package)
          <tr class="border-b border-neutral-200/50 even:bg-emerald-50/20 transition-all duration-200 table-row-hover">
            <td class="p-4 font-medium text-emerald-600 text-sm">{{ $package->id }}</td>
            <td class="p-4">
              <div class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center mr-3">
                  <i class="fa-solid fa-box text-emerald-600 text-sm"></i>
                </div>
                <span class="font-medium text-neutral-800 text-sm">{{ Str::limit($package->name, 40) }}</span>
              </div>
            </td>
            <td class="p-4 text-neutral-600 text-sm">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
            <td class="p-4 text-neutral-600 text-sm">{{ $package->duration }}</td>
            <td class="p-4 text-sm">
              <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $package->is_popular ? 'bg-emerald-100 text-emerald-700' : 'bg-neutral-100 text-neutral-500' }}">
                {{ $package->is_popular ? 'Ya' : 'Tidak' }}
              </span>
            </td>
            <td class="p-4">
              <div class="flex items-center space-x-3">
                <button onclick="showModal(showForm({{ json_encode($package->toArray()) }}))" class="w-9 h-9 rounded-lg bg-accent-blue/10 flex items-center justify-center text-accent-blue hover:bg-accent-blue/20 transition-all" title="Lihat Detail">
                  <i class="fa-solid fa-eye"></i>
                </button>
                <button onclick="showModal(editForm({{ json_encode($package->toArray()) }}))" class="w-9 h-9 rounded-lg bg-accent-amber/10 flex items-center justify-center text-accent-amber hover:bg-accent-amber/20 transition-all" title="Edit">
                  <i class="fa-solid fa-pen"></i>
                </button>
                <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="inline">
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
    @if($packages->hasPages())
    <div class="p-4 border-t border-neutral-200/50 flex items-center justify-between text-sm">
      <div class="text-neutral-600">
        Menampilkan {{ $packages->firstItem() }} - {{ $packages->lastItem() }} dari {{ $packages->total() }} hasil
      </div>
      <div class="flex space-x-2">
        @if($packages->onFirstPage())
        <span class="px-3 py-1 rounded-lg bg-neutral-100 text-neutral-400">
          <i class="fa-solid fa-chevron-left"></i>
        </span>
        @else
        <a href="{{ $packages->previousPageUrl() }}" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
          <i class="fa-solid fa-chevron-left"></i>
        </a>
        @endif
        @if($packages->hasMorePages())
        <a href="{{ $packages->nextPageUrl() }}" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
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
  @if($packages->count() == 0)
  <div class="text-center py-16 animate-slide-in">
    <div class="w-24 h-24 mx-auto rounded-full bg-emerald-50 flex items-center justify-center mb-6">
      <i class="fa-solid fa-box text-emerald-500 text-4xl"></i>
    </div>
    <h3 class="text-xl font-semibold text-neutral-700 mb-2">Belum ada paket</h3>
    <p class="text-neutral-500 mb-6 text-sm">Tambahkan paket pertama untuk layanan Anda</p>
    <button onclick="showModal(createForm())" class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all inline-flex items-center space-x-2">
      <i class="fa-solid fa-plus"></i>
      <span>Tambah Paket</span>
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
      text: "Paket yang dihapus tidak dapat dikembalikan!",
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
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Tambah Paket</h1>
        <form action="{{ route('admin.packages.store') }}" method="POST">
          @csrf
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Nama</label>
            <input type="text" name="name" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Harga</label>
            <input type="number" name="price" step="0.01" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Durasi</label>
            <input type="text" name="duration" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="4" required></textarea>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Fitur (JSON)</label>
            <textarea name="features" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="4" placeholder='["fitur1", "fitur2"]'>["fitur1", "fitur2"]</textarea>
            <p class="text-xs text-neutral-500 mt-1">Masukkan sebagai array JSON, misalnya: ["Fitur 1", "Fitur 2"]</p>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Image URL (opsional)</label>
            <input type="url" name="image_url" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
          </div>
          <div class="mb-5">
            <label class="flex items-center text-neutral-700 font-medium text-sm mb-1">
              <input type="checkbox" name="is_popular" value="1" class="mr-2">
              Populer
            </label>
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
  function editForm(package) {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Edit Paket</h1>
        <form action="/admin/packages/${package.id}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Nama</label>
            <input type="text" name="name" value="${package.name.replace(/"/g, '&quot;')}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Harga</label>
            <input type="number" name="price" step="0.01" value="${package.price}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Durasi</label>
            <input type="text" name="duration" value="${package.duration.replace(/"/g, '&quot;')}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="4" required>${package.description.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</textarea>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Fitur (JSON)</label>
            <textarea name="features" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="4">${package.features}</textarea>
            <p class="text-xs text-neutral-500 mt-1">Masukkan sebagai array JSON, misalnya: ["Fitur 1", "Fitur 2"]</p>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Image URL (opsional)</label>
            <input type="url" name="image_url" value="${package.image_url ? package.image_url.replace(/"/g, '&quot;') : ''}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
          </div>
          <div class="mb-5">
            <label class="flex items-center text-neutral-700 font-medium text-sm mb-1">
              <input type="checkbox" name="is_popular" value="1" ${package.is_popular ? 'checked' : ''} class="mr-2">
              Populer
            </label>
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
  function showForm(package) {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Detail Paket</h1>
        <div class="space-y-4">
          <div class="bg-emerald-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Nama:</p>
            <p class="text-sm text-neutral-800">${package.name.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Harga:</p>
            <p class="text-sm text-neutral-800">Rp ${package.price.toLocaleString('id-ID')}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Durasi:</p>
            <p class="text-sm text-neutral-800">${package.duration.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Deskripsi:</p>
            <p class="text-sm text-neutral-800">${package.description.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Fitur:</p>
            <ul class="text-sm text-neutral-800 list-disc list-inside space-y-1">
              ${package.features ? (() => {
                try {
                  const features = JSON.parse(package.features);
                  return features.map(f => `<li>${f.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</li>`).join('');
                } catch (e) {
                  return '<li>Error parsing JSON</li>';
                }
              })() : '<li>Tidak ada fitur</li>'}
            </ul>
          </div>
          ${package.image_url ? `
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Image:</p>
            <img src="${package.image_url}" class="w-full max-w-md h-auto object-cover rounded-lg" alt="Package Image">
          </div>
          ` : ''}
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Populer:</p>
            <p class="text-sm text-neutral-800">${package.is_popular ? 'Ya' : 'Tidak'}</p>
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