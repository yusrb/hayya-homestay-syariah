<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityImage;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::with('images')->paginate(10);
        return view('admin.facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'icon' => 'nullable',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $facility = Facility::create($request->only(['name', 'description', 'icon']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('facilities', 'public');
                FacilityImage::create([
                    'facility_id' => $facility->id,
                    'file_path' => $path,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'create',
            'sumber' => 'fasilitas',
            'rincian' => 'Menambahkan fasilitas: ' . $facility->name,
        ]);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        $facility->load('images');
        return view('admin.facilities.show', compact('facility'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        $facility->load('images');
        return view('admin.facilities.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'icon' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $facility->update($request->only(['name', 'description', 'icon']));

        if ($request->hasFile('images')) {
            foreach ($facility->images as $image) {
                Storage::disk('public')->delete($image->file_path);
                $image->delete();
            }
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('facilities', 'public');
                FacilityImage::create([
                    'facility_id' => $facility->id,
                    'file_path' => $path,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'update',
            'sumber' => 'fasilitas',
            'rincian' => 'Memperbarui fasilitas: ' . $facility->name,
        ]);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        foreach ($facility->images as $image) {
            Storage::disk('public')->delete($image->file_path);
            $image->delete();
        }
        $facility_name = $facility->name;
        $facility->delete();

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'delete',
            'sumber' => 'fasilitas',
            'rincian' => 'Menghapus fasilitas: ' . $facility_name,
        ]);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}