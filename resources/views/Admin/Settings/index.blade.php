@extends('layouts.app_admin')

@section('title', 'Pengaturan Situs')

@section('content')
<div class="max-w-7xl mx-auto">
    @if ($errors->any())
        <div class="text-accent-red mb-6 animate-fade-in">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-emerald-100 text-emerald-700 rounded-lg animate-slide-in">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 animate-slide-in">
        <div>
            <h1 class="text-3xl font-semibold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">Pengaturan Situs</h1>
            <p class="text-neutral-500 mt-2 text-sm">Kelola pengaturan situs Hayya Syariah dengan mudah</p>
        </div>
        @if(!$setting)
        <button onclick="showModal(createForm())" class="mt-4 md:mt-0 bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all flex items-center space-x-2 card-hover" aria-label="Tambah pengaturan situs">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Pengaturan</span>
        </button>
        @endif
    </div>

    <!-- Settings Display -->
    @if($setting)
    <div class="glass-effect rounded-2xl border border-neutral-200/50 shadow-soft overflow-hidden animate-slide-in">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informasi Pengaturan -->
                <div class="space-y-4">
                    <div class="bg-emerald-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-neutral-600">Nama Situs</h3>
                        <p class="text-lg text-neutral-900">{{ $setting->name }}</p>
                    </div>
                    <div class="bg-neutral-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-neutral-600">Email</h3>
                        <p class="text-lg text-neutral-900">{{ $setting->email ?? 'Tidak tersedia' }}</p>
                    </div>
                    <div class="bg-neutral-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-neutral-600">Telepon</h3>
                        <p class="text-lg text-neutral-900">{{ $setting->phone ?? 'Tidak tersedia' }}</p>
                    </div>
                    <div class="bg-neutral-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-neutral-600">Nomor WhatsApp</h3>
                        <p class="text-lg text-neutral-900">{{ $setting->whatsapp_number ?? 'Tidak tersedia' }}</p>
                    </div>
                    <div class="bg-neutral-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-neutral-600">Alamat</h3>
                        <p class="text-lg text-neutral-900">{{ $setting->address ?? 'Tidak tersedia' }}</p>
                    </div>
                    <div class="bg-neutral-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-neutral-600">Peta</h3>
                        <button onclick="showModal(showMapForm({{ json_encode($setting->toArray()) }}))" class="text-accent-blue hover:underline text-lg" aria-label="Lihat peta lokasi">Lihat Peta</button>
                    </div>
                    <div class="bg-neutral-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-neutral-600">Deskripsi</h3>
                        <p class="text-lg text-neutral-900">{{ $setting->description ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>
                <!-- Logo -->
                <div class="flex flex-col items-center">
                    <h3 class="text-sm font-medium text-neutral-600 mb-2">Logo Situs</h3>
                    @if($setting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo {{ $setting->name }}" class="w-32 h-32 object-contain rounded-lg border border-emerald-100">
                    @else
                    <div class="w-32 h-32 bg-neutral-100 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-image text-neutral-400 text-2xl"></i>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Aksi -->
            <div class="mt-6 flex space-x-3">
                <button onclick="showModal(editForm({{ json_encode($setting->toArray()) }}))" class="bg-gradient-to-r from-amber-600 to-amber-500 text-white px-5 py-2 rounded-lg hover:shadow-softer transition-all flex items-center space-x-2 card-hover" aria-label="Edit pengaturan situs">
                    <i class="fa-solid fa-pen"></i>
                    <span>Edit Pengaturan</span>
                </button>
                <form action="{{ route('admin.settings.destroy', $setting->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gradient-to-r from-red-600 to-red-500 text-white px-5 py-2 rounded-lg hover:shadow-softer transition-all flex items-center space-x-2 card-hover" onclick="return confirmDelete(event)" aria-label="Hapus pengaturan situs">
                        <i class="fa-solid fa-trash"></i>
                        <span>Hapus Pengaturan</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16 animate-slide-in">
        <div class="w-24 h-24 mx-auto rounded-full bg-emerald-50 flex items-center justify-center mb-6">
            <i class="fa-solid fa-cog text-emerald-500 text-4xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-neutral-700 mb-2">Belum ada pengaturan</h3>
        <p class="text-neutral-500 mb-6 text-sm">Tambahkan pengaturan situs untuk memulai</p>
        <button onclick="showModal(createForm())" class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all inline-flex items-center space-x-2 card-hover" aria-label="Tambah pengaturan situs">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Pengaturan</span>
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
            text: "Pengaturan yang dihapus tidak dapat dikembalikan!",
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
                <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors" aria-label="Tutup modal">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
                <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Tambah Pengaturan Situs</h1>
                <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="name">Nama Situs *</label>
                                <input type="text" name="name" id="name" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="email">Email</label>
                                <input type="email" name="email" id="email" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="phone">Telepon</label>
                                <input type="text" name="phone" id="phone" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="whatsapp_number">Nomor WhatsApp</label>
                                <input type="text" name="whatsapp_number" id="whatsapp_number" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="address">Alamat</label>
                                <textarea name="address" id="address" rows="3" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors"></textarea>
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="map_embed_url">Embed Google Maps</label>
                                <textarea name="map_embed_url" id="map_embed_url" rows="3" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors"></textarea>
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="description">Deskripsi</label>
                                <textarea name="description" id="description" rows="5" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors"></textarea>
                            </div>
                        </div>
                        <div class="flex flex-col items-center">
                            <label class="block text-neutral-700 font-medium text-sm mb-1" for="logo">Logo Situs</label>
                            <input type="file" name="logo" id="logo" accept="image/jpeg,image/png" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                            <p class="text-xs text-neutral-500 mt-1">Format: JPG, PNG, maks. 2MB</p>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal()" class="bg-neutral-100 text-neutral-600 px-4 py-2 rounded-lg text-sm hover:bg-neutral-200 transition-colors card-hover" aria-label="Batal">Batal</button>
                        <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-600 transition-colors card-hover" aria-label="Simpan pengaturan">Simpan</button>
                    </div>
                </form>
            </div>
        `;
    }

    // Edit Form Modal
    function editForm(setting) {
        return `
            <div class="relative p-6">
                <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors" aria-label="Tutup modal">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
                <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Edit Pengaturan Situs</h1>
                <form action="/admin/settings/${setting.id}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="name">Nama Situs *</label>
                                <input type="text" name="name" id="name" value="${setting.name.replace(/"/g, '&quot;')}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="email">Email</label>
                                <input type="email" name="email" id="email" value="${setting.email ? setting.email.replace(/"/g, '&quot;') : ''}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="phone">Telepon</label>
                                <input type="text" name="phone" id="phone" value="${setting.phone ? setting.phone.replace(/"/g, '&quot;') : ''}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="whatsapp_number">Nomor WhatsApp</label>
                                <input type="text" name="whatsapp_number" id="whatsapp_number" value="${setting.whatsapp_number ? setting.whatsapp_number.replace(/"/g, '&quot;') : ''}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="address">Alamat</label>
                                <textarea name="address" id="address" rows="3" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">${setting.address ? setting.address.replace(/</g, '&lt;').replace(/>/g, '&gt;') : ''}</textarea>
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="map_embed_url">Embed Google Maps</label>
                                <textarea name="map_embed_url" id="map_embed_url" rows="3" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">${setting.map_embed_url ? setting.map_embed_url.replace(/</g, '&lt;').replace(/>/g, '&gt;') : ''}</textarea>
                            </div>
                            <div>
                                <label class="block text-neutral-700 font-medium text-sm mb-1" for="description">Deskripsi</label>
                                <textarea name="description" id="description" rows="5" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">${setting.description ? setting.description.replace(/</g, '&lt;').replace(/>/g, '&gt;') : ''}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-col items-center">
                            <label class="block text-neutral-700 font-medium text-sm mb-1" for="logo">Logo Situs</label>
                            ${setting.logo ? `
                            <img src="/storage/${setting.logo}" alt="Logo ${setting.name}" class="w-32 h-32 object-contain rounded-lg border border-emerald-100 mb-4">
                            ` : `
                            <div class="w-32 h-32 bg-neutral-100 rounded-lg flex items-center justify-center mb-4">
                                <i class="fa-solid fa-image text-neutral-400 text-2xl"></i>
                            </div>
                            `}
                            <input type="file" name="logo" id="logo" accept="image/jpeg,image/png" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                            <p class="text-xs text-neutral-500 mt-1">Format: JPG, PNG, maks. 2MB</p>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal()" class="bg-neutral-100 text-neutral-600 px-4 py-2 rounded-lg text-sm hover:bg-neutral-200 transition-colors card-hover" aria-label="Batal">Batal</button>
                        <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-600 transition-colors card-hover" aria-label="Perbarui pengaturan">Perbarui</button>
                    </div>
                </form>
            </div>
        `;
    }

    // Show Map Modal
    function showMapForm(setting) {
        // Ekstrak src dari map_embed_url
        let mapSrc = '';
        if (setting.map_embed_url) {
            const match = setting.map_embed_url.match(/src=["'](.*?)["']/);
            mapSrc = match ? match[1] : setting.map_embed_url;
        }
        return `
            <div class="relative p-6">
                <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors" aria-label="Tutup modal">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
                <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Detail Peta Lokasi</h1>
                <div class="space-y-4">
                    <div class="bg-neutral-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-neutral-600 mb-1">Embed Google Maps:</p>
                        <p class="text-sm text-neutral-800 break-all">${setting.map_embed_url ? setting.map_embed_url.replace(/</g, '&lt;').replace(/>/g, '&gt;') : 'Tidak tersedia'}</p>
                    </div>
                    <div class="bg-neutral-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-neutral-600 mb-1">Pratinjau Peta:</p>
                        ${mapSrc ? `
                        <iframe src="${mapSrc.replace(/"/g, '&quot;')}" class="w-full h-64 rounded-lg border border-emerald-100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" aria-label="Pratinjau peta lokasi"></iframe>
                        ` : '<p class="text-sm text-neutral-500">Tidak ada pratinjau peta tersedia.</p>'}
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button onclick="closeModal()" class="bg-neutral-100 text-neutral-600 px-4 py-2 rounded-lg text-sm hover:bg-neutral-200 transition-colors card-hover" aria-label="Tutup">Tutup</button>
                </div>
            </div>
        `;
    }

    // Modal handling
    function showModal(content) {
        Swal.fire({
            html: content,
            showConfirmButton: false,
            showCloseButton: false,
            customClass: {
                popup: 'w-full max-w-lg rounded-2xl glass-effect shadow-softer'
            },
            didOpen: () => {
                const focusableElements = Swal.getPopup().querySelectorAll('button, [href], input, select, textarea');
                const firstElement = focusableElements[0];
                const lastElement = focusableElements[focusableElements.length - 1];
                
                Swal.getPopup().addEventListener('keydown', (e) => {
                    if (e.key === 'Tab') {
                        if (e.shiftKey && document.activeElement === firstElement) {
                            e.preventDefault();
                            lastElement.focus();
                        } else if (!e.shiftKey && document.activeElement === lastElement) {
                            e.preventDefault();
                            firstElement.focus();
                        }
                    }
                });
                firstElement.focus();
            }
        });
    }

    function closeModal() {
        Swal.close();
    }
</script>
@endsection