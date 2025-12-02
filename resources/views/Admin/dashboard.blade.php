@extends('layouts.app_admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto animate-slide-in">

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <div class="card-hover bg-white rounded-2xl p-6 shadow-soft border border-neutral-200/50">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-sm font-semibold text-neutral-600">Total Glamping</h3>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $glampingCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <i class="fa-solid fa-tent text-emerald-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-hover bg-white rounded-2xl p-6 shadow-soft border border-neutral-200/50">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-sm font-semibold text-neutral-600">Total Fasilitas</h3>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $facilityCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <i class="fa-solid fa-building text-emerald-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-hover bg-white rounded-2xl p-6 shadow-soft border border-neutral-200/50">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-sm font-semibold text-neutral-600">Total Paket</h3>
                    <p class="text-3xl font-bold text-accent-amber mt-2">{{ $packageCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-accent-amber/10 flex items-center justify-center">
                    <i class="fa-solid fa-box text-accent-amber text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-hover bg-white rounded-2xl p-6 shadow-soft border border-neutral-200/50">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-sm font-semibold text-neutral-600">Item Galeri</h3>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $galleryCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <i class="fa-solid fa-image text-emerald-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-hover bg-white rounded-2xl p-6 shadow-soft border border-neutral-200/50">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-sm font-semibold text-neutral-600">Testimoni</h3>
                    <p class="text-3xl font-bold text-accent-amber mt-2">{{ $testimonialCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-accent-amber/10 flex items-center justify-center">
                    <i class="fa-solid fa-comments text-accent-amber text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-hover bg-white rounded-2xl p-6 shadow-soft border border-neutral-200/50">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-sm font-semibold text-neutral-600">FAQ</h3>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $faqCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <i class="fa-solid fa-circle-question text-emerald-600 text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Grafik dan Aktivitas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

        <!-- Grafik Selalu Muncul -->
        <div class="glass-effect rounded-2xl p-6 shadow-soft border border-neutral-200/50">
            <h3 class="text-lg font-semibold text-neutral-700 mb-4">Aktivitas Pengunjung (30 Hari Terakhir)</h3>

            <div class="h-64 flex items-center justify-center">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="glass-effect rounded-2xl p-6 shadow-soft border border-neutral-200/50">
            <h3 class="text-lg font-semibold text-neutral-700 mb-4">Aktivitas Terbaru</h3>

            <div class="max-h-64 overflow-y-auto space-y-4 pr-2">
                @forelse($recentActivities as $activity)
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center mr-3">
                            <i class="fa-solid fa-{{ $activity->aksi == 'create' ? 'plus' : ($activity->aksi == 'update' ? 'pen' : 'trash') }} text-emerald-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-neutral-700">
                                {{ $activity->user?->name ?? 'Sistem' }}: {{ $activity->rincian }}
                            </p>
                            <p class="text-xs text-neutral-500">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-neutral-500 text-center py-8">Belum ada aktivitas</p>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Aksi Cepat -->
    <div class="glass-effect rounded-2xl p-6 shadow-soft border border-neutral-200/50">
        <h3 class="text-lg font-semibold text-neutral-700 mb-4">Aksi Cepat</h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <a href="{{ route('admin.glampings.create') }}"
               class="flex flex-col items-center justify-center p-4 rounded-lg bg-emerald-50 hover:bg-emerald-100 transition-all card-hover">
                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center mb-2">
                    <i class="fa-solid fa-plus text-emerald-600"></i>
                </div>
                <span class="text-sm font-medium text-emerald-700">Tambah Glamping</span>
            </a>

            <a href="{{ route('admin.facilities.create') }}"
               class="flex flex-col items-center justify-center p-4 rounded-lg bg-emerald-50 hover:bg-emerald-100 transition-all card-hover">
                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center mb-2">
                    <i class="fa-solid fa-plus text-emerald-600"></i>
                </div>
                <span class="text-sm font-medium text-emerald-700">Tambah Fasilitas</span>
            </a>

            <a href="{{ route('admin.packages.create') }}"
               class="flex flex-col items-center justify-center p-4 rounded-lg bg-accent-amber/10 hover:bg-accent-amber/20 transition-all card-hover">
                <div class="w-12 h-12 rounded-full bg-accent-amber/20 flex items-center justify-center mb-2">
                    <i class="fa-solid fa-plus text-accent-amber"></i>
                </div>
                <span class="text-sm font-medium text-accent-amber">Tambah Paket</span>
            </a>

            <a href="{{ route('admin.gallery_items.create') }}"
               class="flex flex-col items-center justify-center p-4 rounded-lg bg-emerald-50 hover:bg-emerald-100 transition-all card-hover">
                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center mb-2">
                    <i class="fa-solid fa-plus text-emerald-600"></i>
                </div>
                <span class="text-sm font-medium text-emerald-700">Tambah Galeri</span>
            </a>

        </div>
    </div>

</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('visitorChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($days),
            datasets: [{
                label: 'Pengunjung',
                data: @json($visitorData),
                borderColor: '#14b8a6',
                backgroundColor: 'rgba(20, 184, 166, 0.15)',
                borderWidth: 3,
                pointBackgroundColor: '#14b8a6',
                pointRadius: 5,
                pointHoverRadius: 8,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true },
                x: { grid: { display: false } }
            }
        }
    });

});
</script>
@endsection
