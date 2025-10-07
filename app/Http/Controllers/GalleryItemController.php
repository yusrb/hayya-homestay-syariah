<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleryItems = GalleryItem::paginate(10);
        return view('admin.gallery_items.index', compact('galleryItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:foto,video',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:jpg,png,mp4,mov|max:300240',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('gallery', 'public');

        $galleryItem = GalleryItem::create([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'create',
            'sumber' => 'galeri',
            'rincian' => 'Menambahkan item galeri: ' . $galleryItem->title,
        ]);

        return redirect()->route('admin.gallery_items.index')->with('success', 'Item galeri berhasil disimpan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryItem $galleryItem)
    {
        $request->validate([
            'type' => 'required|in:foto,video',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,png,mp4,mov|max:300240',
        ]);

        $data = $request->only(['type', 'title', 'description']);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($galleryItem->file_path);
            $file = $request->file('file');
            $data['file_path'] = $file->store('gallery', 'public');
        }

        $galleryItem->update($data);

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'update',
            'sumber' => 'galeri',
            'rincian' => 'Memperbarui item galeri: ' . $galleryItem->title,
        ]);

        return redirect()->route('admin.gallery_items.index')->with('success', 'Item galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryItem $galleryItem)
    {
        $galleryItemTitle = $galleryItem->title;
        Storage::disk('public')->delete($galleryItem->file_path);
        $galleryItem->delete();

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'delete',
            'sumber' => 'galeri',
            'rincian' => 'Menghapus item galeri: ' . $galleryItemTitle,
        ]);

        return redirect()->route('admin.gallery_items.index')->with('success', 'Item galeri berhasil dihapus.');
    }
}