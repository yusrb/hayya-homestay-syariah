<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Package;
use App\Models\GalleryItem;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\Glamping;
use App\Models\LogPengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request)
    {
        $today = now()->toDateString();
        $visitKey = 'kunjungan_' . $today;

        if (!Session::has($visitKey) && !$request->hasCookie($visitKey)) {
            $log = LogPengunjung::firstOrCreate(
                ['tanggal' => $today],
                ['jumlah_kunjungan' => 0]
            );
            $log->increment('jumlah_kunjungan');
            Session::put($visitKey, true);
        }

        $facilities = Facility::take(6)->get();
        $packages = Package::take(6)->get();
        $galleryItems = GalleryItem::take(6)->get();
        $testimonials = Testimonial::take(3)->get();
        $faqs = Faq::take(6)->get();
        $setting = Setting::first();
        $glampings = Glamping::with('images')->where('status', 'available')->get();

        $config = [
            'whatsapp_number' => $setting->whatsapp_number ?? '+6281234567890',
            'google_maps_url' => $setting->google_maps_url ?? 'https://maps.google.com?q=Jl.+Raya+Lembang+No.+123,+Desa+Cikole,+Lembang,+Bandung+Barat+40391',
            'phone_number' => $setting->phone ?? '+6281234567890',
        ];

        return response()->view('public.home.index', compact('facilities', 'packages', 'galleryItems', 'testimonials', 'faqs', 'setting', 'config', 'glampings'))
            ->withCookie(cookie($visitKey, true, 1440));
    }

    public function showKamar(Request $request)
    {
        $today = now()->toDateString();
        $visitKey = 'kunjungan_' . $today;

        if (!Session::has($visitKey) && !$request->hasCookie($visitKey)) {
            $log = LogPengunjung::firstOrCreate(
                ['tanggal' => $today],
                ['jumlah_kunjungan' => 0]
            );
            $log->increment('jumlah_kunjungan');
            Session::put($visitKey, true);
        }

        $glampings = Glamping::with('images')->paginate(10);
        $setting = Setting::first();
        $config = [
            'whatsapp_number' => $setting->whatsapp_number ?? '+6281234567890',
            'phone_number' => $setting->phone ?? '+6281234567890',
        ];

        return response()->view('public.home.kamar', compact('glampings', 'setting', 'config'))
            ->withCookie(cookie($visitKey, true, 1440));
    }
}