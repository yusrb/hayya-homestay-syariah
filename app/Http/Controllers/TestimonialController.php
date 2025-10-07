<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048',
            'source' => 'nullable|string|max:255',
            'date' => 'nullable|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial = Testimonial::create($data);

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'create',
            'sumber' => 'testimoni',
            'rincian' => 'Menambahkan testimoni: ' . $testimonial->name,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048',
            'source' => 'nullable|string|max:255',
            'date' => 'nullable|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'update',
            'sumber' => 'testimoni',
            'rincian' => 'Memperbarui testimoni: ' . $testimonial->name,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial_name = $testimonial->name;
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'delete',
            'sumber' => 'testimoni',
            'rincian' => 'Menghapus testimoni: ' . $testimonial_name,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}