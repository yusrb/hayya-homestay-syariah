@extends('layouts.app_admin')

@section('title', 'Pengguna')

@section('content')
<div class="max-w-7xl mx-auto">
    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-700 p-4 rounded-xl mb-6 animate-fade-in">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between mb-8">
        <div>
            <h1 class="text-3xl font-semibold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">
                Pengguna
            </h1>
            <p class="text-neutral-500 mt-2 text-sm">Kelola semua akun Hayya Syariah</p>
        </div>
        <button onclick="showModal(createForm())" 
                class="mt-4 md:mt-0 bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all flex items-center space-x-2">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Pengguna</span>
        </button>
    </div>

    <div class="glass-effect rounded-2xl border border-neutral-200/50 shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white">
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Nama</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-left">Terdaftar</th>
                        <th class="p-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b even:bg-emerald-50/20 hover:bg-emerald-50/50 transition-all table-row-hover">
                        <td class="p-4 text-sm font-medium text-emerald-600">{{ $user->id }}</td>
                        <td class="p-4 text-sm">{{ $user->name }}</td>
                        <td class="p-4 text-sm">{{ $user->email }}</td>
                        <td class="p-4 text-sm text-neutral-500">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="p-4">
                            <div class="flex space-x-2">
                                <button onclick="showModal(editForm({{ json_encode($user) }}))" 
                                        class="w-9 h-9 rounded-lg bg-accent-amber/10 flex items-center justify-center text-accent-amber hover:bg-accent-amber/20">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirmDelete(event)" 
                                            class="w-9 h-9 rounded-lg bg-accent-red/10 flex items-center justify-center text-accent-red hover:bg-accent-red/20">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-neutral-200/50">
            {{ $users->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function createForm() {
    return `
        <div class="relative p-6">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
            <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Tambah Pengguna</h1>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-neutral-700 font-medium text-sm mb-1">Nama</label>
                    <input type="text" name="name" required class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                </div>
                <div class="mb-5">
                    <label class="block text-neutral-700 font-medium text-sm mb-1">Email</label>
                    <input type="email" name="email" required class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                </div>
                <div class="mb-5">
                    <label class="block text-neutral-700 font-medium text-sm mb-1">Password</label>
                    <input type="password" name="password" required minlength="8" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                </div>
                <div class="mb-5">
                    <label class="block text-neutral-700 font-medium text-sm mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required minlength="8" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="bg-neutral-100 text-neutral-600 px-4 py-2 rounded-lg text-sm hover:bg-neutral-200">Batal</button>
                    <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-600">Simpan</button>
                </div>
            </form>
        </div>
    `;
}

function editForm(user) {
    return `
        <div class="relative p-6">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
            <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Edit Pengguna</h1>
            <form action="{{ url('admin/users') }}/${user.id}" method="POST">
                @csrf @method('PUT')
                <div class="mb-5">
                    <label class="block text-neutral-700 font-medium text-sm mb-1">Nama</label>
                    <input type="text" name="name" value="${user.name}" required class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                </div>
                <div class="mb-5">
                    <label class="block text-neutral-700 font-medium text-sm mb-1">Email</label>
                    <input type="email" name="email" value="${user.email}" required class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                </div>
                <div class="mb-5">
                    <label class="block text-neutral-700 font-medium text-sm mb-1">Password Baru <span class="text-neutral-500">(kosongkan jika tidak diganti)</span></label>
                    <input type="password" name="password" minlength="8" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                </div>
                <div class="mb-5">
                    <label class="block text-neutral-700 font-medium text-sm mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" minlength="8" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="bg-neutral-100 text-neutral-600 px-4 py-2 rounded-lg text-sm hover:bg-neutral-200">Batal</button>
                    <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-600">Update</button>
                </div>
            </form>
        </div>
    `;
}

function confirmDelete(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Yakin menghapus?',
        text: "Pengguna ini akan hilang selamanya.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#14b8a6',
        cancelButtonColor: '#ef4444',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.closest('form').submit();
        }
    });
}
</script>
@endsection