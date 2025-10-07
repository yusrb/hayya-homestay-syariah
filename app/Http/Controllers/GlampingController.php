<?php

namespace App\Http\Controllers;

use App\Models\Glamping;
use App\Models\GlampingImage;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GlampingController extends Controller
{
    public function index()
    {
        $glampings = Glamping::with('images')->paginate(10);
        return view('Admin.Glamping.index', compact('glampings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:standard,deluxe,family',
            'description' => 'nullable|string',
            'status' => 'required|in:available,unavailable',
            'capacity' => 'required|integer|min:1',
            'beds' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
            'rating' => 'required|integer|min:0|max:5',
            'images.*' => 'required|image|mimes:jpeg,png|max:10240',
        ]);

        $glamping = Glamping::create($request->only([
            'title', 'type', 'description', 'status', 'capacity', 'beds', 'price', 'rating'
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('glamping_images', 'public');
                GlampingImage::create([
                    'glamping_id' => $glamping->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'create',
            'sumber' => 'glamping',
            'rincian' => 'Menambahkan glamping: ' . $glamping->title,
        ]);

        return redirect()->route('admin.glampings.index')->with('success', 'Glamping berhasil ditambahkan.');
    }

    public function update(Request $request, Glamping $glamping)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:standard,deluxe,family',
            'description' => 'nullable|string',
            'status' => 'required|in:available,unavailable',
            'capacity' => 'required|integer|min:1',
            'beds' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
            'rating' => 'required|integer|min:0|max:5',
            'images.*' => 'nullable|image|mimes:jpeg,png|max:10240',
        ]);

        $glamping->update($request->only([
            'title', 'type', 'description', 'status', 'capacity', 'beds', 'price', 'rating'
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('glamping_images', 'public');
                GlampingImage::create([
                    'glamping_id' => $glamping->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'update',
            'sumber' => 'glamping',
            'rincian' => 'Memperbarui glamping: ' . $glamping->title,
        ]);

        return redirect()->route('admin.glampings.index')->with('success', 'Glamping berhasil diperbarui.');
    }

    public function destroy(Glamping $glamping)
    {
        $glamping_title = $glamping->title;
        foreach ($glamping->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        $glamping->delete();

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'delete',
            'sumber' => 'glamping',
            'rincian' => 'Menghapus glamping: ' . $glamping_title,
        ]);

        return redirect()->route('admin.glampings.index')->with('success', 'Glamping berhasil dihapus.');
    }

    public function destroyImage(GlampingImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'delete',
            'sumber' => 'glamping_image',
            'rincian' => 'Menghapus gambar glamping: ' . $image->image_path,
        ]);

        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }
}