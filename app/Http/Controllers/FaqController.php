<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::paginate(5);
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = Faq::create($request->all());

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'create',
            'sumber' => 'faq',
            'rincian' => 'Menambahkan FAQ: ' . $faq->question,
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq->update($request->all());

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'update',
            'sumber' => 'faq',
            'rincian' => 'Memperbarui FAQ: ' . $faq->question,
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq_question = $faq->question;
        $faq->delete();

        LogAktivitas::create([
            'id_pengguna' => Auth::id(),
            'aksi' => 'delete',
            'sumber' => 'faq',
            'rincian' => 'Menghapus FAQ: ' . $faq_question,
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus.');
    }
}