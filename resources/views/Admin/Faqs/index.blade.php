@extends('layouts.app_admin')

@section('title', 'FAQ')

@section('content')
<div class="max-w-7xl mx-auto">
  <!-- Header -->
  <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
    <div>
      <h1 class="text-3xl font-semibold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">Daftar FAQ</h1>
      <p class="text-neutral-500 mt-2 text-sm">Kelola pertanyaan yang sering diajukan di Hayya Syariah</p>
    </div>
    <button onclick="showModal(createForm())" class="mt-4 md:mt-0 bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all flex items-center space-x-2">
      <i class="fa-solid fa-plus"></i>
      <span>Tambah FAQ</span>
    </button>
  </div>

  <!-- Table Container -->
  <div class="glass-effect rounded-2xl border border-neutral-200/50 shadow-soft overflow-hidden animate-slide-in">
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white">
            <th class="p-4 text-left font-semibold text-sm">ID</th>
            <th class="p-4 text-left font-semibold text-sm">Pertanyaan</th>
            <th class="p-4 text-left font-semibold text-sm">Jawaban</th>
            <th class="p-4 text-left font-semibold text-sm">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($faqs as $faq)
          <tr class="border-b border-neutral-200/50 even:bg-emerald-50/20 transition-all duration-200 table-row-hover">
            <td class="p-4 font-medium text-emerald-600 text-sm">{{ $faq->id }}</td>
            <td class="p-4">
              <div class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center mr-3">
                  <i class="fa-solid fa-question text-emerald-600 text-sm"></i>
                </div>
                <span class="font-medium text-neutral-800 text-sm">{{ Str::limit($faq->question, 60) }}</span>
              </div>
            </td>
            <td class="p-4 text-neutral-600 max-w-md text-sm">{{ Str::limit($faq->answer, 80) }}</td>
            <td class="p-4">
              <div class="flex items-center space-x-3">
                <button onclick="showModal(showForm({{ json_encode($faq->toArray()) }}))" class="w-9 h-9 rounded-lg bg-accent-blue/10 flex items-center justify-center text-accent-blue hover:bg-accent-blue/20 transition-all" title="Lihat Detail">
                  <i class="fa-solid fa-eye"></i>
                </button>
                <button onclick="showModal(editForm({{ json_encode($faq->toArray()) }}))" class="w-9 h-9 rounded-lg bg-accent-amber/10 flex items-center justify-center text-accent-amber hover:bg-accent-amber/20 transition-all" title="Edit">
                  <i class="fa-solid fa-pen"></i>
                </button>
                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline">
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
    @if($faqs->hasPages())
    <div class="p-4 border-t border-neutral-200/50 flex items-center justify-between text-sm">
      <div class="text-neutral-600">
        Menampilkan {{ $faqs->firstItem() }} - {{ $faqs->lastItem() }} dari {{ $faqs->total() }} hasil
      </div>
      <div class="flex space-x-2">
        @if($faqs->onFirstPage())
        <span class="px-3 py-1 rounded-lg bg-neutral-100 text-neutral-400">
          <i class="fa-solid fa-chevron-left"></i>
        </span>
        @else
        <a href="{{ $faqs->previousPageUrl() }}" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
          <i class="fa-solid fa-chevron-left"></i>
        </a>
        @endif
        @if($faqs->hasMorePages())
        <a href="{{ $faqs->nextPageUrl() }}" class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
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
  @if($faqs->count() == 0)
  <div class="text-center py-16 animate-slide-in">
    <div class="w-24 h-24 mx-auto rounded-full bg-emerald-50 flex items-center justify-center mb-6">
      <i class="fa-solid fa-question text-emerald-500 text-4xl"></i>
    </div>
    <h3 class="text-xl font-semibold text-neutral-700 mb-2">Belum ada FAQ</h3>
    <p class="text-neutral-500 mb-6 text-sm">Tambahkan FAQ pertama untuk membantu pengguna</p>
    <button onclick="showModal(createForm())" class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-5 py-2.5 rounded-xl hover:shadow-softer transition-all inline-flex items-center space-x-2">
      <i class="fa-solid fa-plus"></i>
      <span>Tambah FAQ</span>
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
      text: "FAQ yang dihapus tidak dapat dikembalikan!",
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
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Tambah FAQ</h1>
        <form action="{{ route('admin.faqs.store') }}" method="POST">
          @csrf
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Pertanyaan</label>
            <input type="text" name="question" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Jawaban</label>
            <textarea name="answer" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="5" required></textarea>
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
  function editForm(faq) {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Edit FAQ</h1>
        <form action="/admin/faqs/${faq.id}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Pertanyaan</label>
            <input type="text" name="question" value="${faq.question.replace(/"/g, '&quot;')}" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" required>
          </div>
          <div class="mb-5">
            <label class="block text-neutral-700 font-medium text-sm mb-1">Jawaban</label>
            <textarea name="answer" class="w-full border border-neutral-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-colors" rows="5" required>${faq.answer.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</textarea>
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
  function showForm(faq) {
    return `
      <div class="relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-700 transition-colors">
          <i class="fa-solid fa-times text-xl"></i>
        </button>
        <h1 class="text-2xl font-semibold text-emerald-600 mb-6">Detail FAQ</h1>
        <div class="space-y-4">
          <div class="bg-emerald-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Pertanyaan:</p>
            <p class="text-sm text-neutral-800">${faq.question.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
          </div>
          <div class="bg-neutral-50 p-4 rounded-lg">
            <p class="text-sm font-medium text-neutral-700 mb-1">Jawaban:</p>
            <p class="text-sm text-neutral-800">${faq.answer.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>
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