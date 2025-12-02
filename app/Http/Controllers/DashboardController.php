<?php

namespace App\Http\Controllers;

use App\Models\Glamping;
use App\Models\Facility;
use App\Models\Package;
use App\Models\GalleryItem;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\LogPengunjung;
use App\Models\LogAktivitas;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $glampingCount     = Glamping::count();
        $facilityCount     = Facility::count();
        $packageCount      = Package::count();
        $galleryCount      = GalleryItem::count();
        $testimonialCount  = Testimonial::count();
        $faqCount          = Faq::count();

        $endDate   = Carbon::today();               
        $startDate = $endDate->copy()->subDays(29); 

        $logs = LogPengunjung::whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->format('Y-m-d');
            });

        $days        = [];
        $visitorData = [];

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $key   = $date->format('Y-m-d');
            $label = $date->translatedFormat('d M');

            $days[] = $label;
            $visitorData[] = isset($logs[$key])
                ? $logs[$key]->sum('jumlah_kunjungan')
                : 0;
        }

        if (empty(array_filter($visitorData))) {
            $visitorData = array_fill(0, 30, 0);
        }

        $recentActivities = LogAktivitas::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'glampingCount',
            'facilityCount',
            'packageCount',
            'galleryCount',
            'testimonialCount',
            'faqCount',
            'days',
            'visitorData',
            'recentActivities'
        ));
    }
}
