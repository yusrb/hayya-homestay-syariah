<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'map_embed_url' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $setting = Setting::create($validated);

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'create',
            'sumber' => 'pengaturan',
            'rincian' => 'Menambahkan pengaturan: ' . $setting->name,
        ]);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'map_embed_url' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $setting->update($validated);

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'update',
            'sumber' => 'pengaturan',
            'rincian' => 'Memperbarui pengaturan: ' . $setting->name,
        ]);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting_name = $setting->name;
        if ($setting->logo) {
            Storage::disk('public')->delete($setting->logo);
        }
        $setting->delete();

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'delete',
            'sumber' => 'pengaturan',
            'rincian' => 'Menghapus pengaturan: ' . $setting_name,
        ]);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil dihapus.');
    }
}