<?php

use App\Http\Controllers\GlampingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryItemController;
use App\Http\Controllers\TestimonialController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/kamar', [HomeController::class, 'showKamar'])->name('home.kamar');

Route::get('/facilities', [HomeController::class, 'facilities'])->name('facilities');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');

Route::get('/admin', function() {
    return redirect()->route('login');
});

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::delete('glampings/images/{image}', [GlampingController::class, 'destroyImage'])->name('glampings.images.destroy');

    Route::resources([
        'glampings'     => GlampingController::class,
        'facilities'    => FacilityController::class,
        'packages'      => PackageController::class,
        'gallery_items' => GalleryItemController::class,
        'testimonials'  => TestimonialController::class,
        'faqs'          => FaqController::class,
        'settings'      => SettingsController::class,
    ]);
});