<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use Illuminate\Http\Request;

class SaranController extends Controller
{
    public function index()
    {
        $sarans = Saran::latest()->get();

        return view('sarans.index', compact('sarans'));
    }

    public function create()
    {
        return view('sarans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:menunggu,diproses,selesai',
        ]);

        Saran::create($validated);

        return redirect()
            ->route('sarans.index')
            ->with('success', 'Saran berhasil ditambahkan.');
    }

    public function show(Saran $saran)
    {
        return view('sarans.show', compact('saran'));
    }

    public function edit(Saran $saran)
    {
        return view('sarans.edit', compact('saran'));
    }

    public function update(Request $request, Saran $saran)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:menunggu,diproses,selesai',
        ]);

        $saran->update($validated);

        return redirect()
            ->route('sarans.index')
            ->with('success', 'Saran berhasil diperbarui.');
    }

    public function destroy(Saran $saran)
    {
        $saran->delete();

        return redirect()
            ->route('sarans.index')
            ->with('success', 'Saran berhasil dihapus.');
    }
}