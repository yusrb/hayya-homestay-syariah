<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Glamping;
use App\Models\Facility;
use App\Models\Package;
use App\Models\GalleryItem;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\LogPengunjung;
use App\Models\LogAktivitas;

class DashboardController extends Controller
{
    public function index()
    {
        $glampingCount = Glamping::count();
        $facilityCount = Facility::count();
        $packageCount = Package::count();
        $galleryCount = GalleryItem::count();
        $testimonialCount = Testimonial::count();
        $faqCount = Faq::count();

        $visitorLogs = LogPengunjung::thisWeek()->get();
        $visitorData = [];
        $period = now()->startOfWeek()->toPeriod(now()); 
        $days = collect(iterator_to_array($period))
            ->map(fn($day) => $day->format('D'))
            ->toArray();


        foreach ($days as $index => $day) {
            $date = now()->startOfWeek()->addDays($index)->toDateString();
            $visitorData[$date] = $visitorLogs->where('tanggal', $date)->first()->jumlah_kunjungan ?? 0;
        }

        // Log aktivitas terbaru
        $recentActivities = LogAktivitas::recent()->with('user')->get();

        return view('admin.dashboard', compact(
            'glampingCount', 'facilityCount', 'packageCount', 'galleryCount',
            'testimonialCount', 'faqCount', 'visitorData', 'days', 'recentActivities'
        ));
    }
}