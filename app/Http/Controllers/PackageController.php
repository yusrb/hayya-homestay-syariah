<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::paginate(5);
        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required',
            'description' => 'required',
            'features' => 'required|json',
            'image_url' => 'nullable|url',
            'is_popular' => 'boolean',
        ]);

        $package = Package::create($request->all());

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'create',
            'sumber' => 'paket',
            'rincian' => 'Menambahkan paket: ' . $package->name,
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required',
            'description' => 'required',
            'features' => 'required|json',
            'image_url' => 'nullable|url',
            'is_popular' => 'boolean',
        ]);

        $package->update($request->all());

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'update',
            'sumber' => 'paket',
            'rincian' => 'Memperbarui paket: ' . $package->name,
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package_name = $package->name;
        $package->delete();

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'delete',
            'sumber' => 'paket',
            'rincian' => 'Menghapus paket: ' . $package_name,
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus.');
    }
}