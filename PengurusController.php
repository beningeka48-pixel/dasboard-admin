<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    /**
     * Menampilkan semua data pengurus.
     */
    public function index()
    {
        $pengurus = Pengurus::latest()->get();

        return view('pengurus.index', compact('pengurus'));
    }

    /**
     * Menampilkan form tambah pengurus.
     */
    public function create()
    {
        return view('pengurus.create');
    }

    /**
     * Menyimpan data pengurus baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'lembaga' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'periode' => 'nullable|string|max:100',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('pengurus', 'public');
        }

        Pengurus::create($validated);

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pengurus.
     */
    public function show(Pengurus $pengurus)
    {
        return view('pengurus.show', compact('pengurus'));
    }

    /**
     * Menampilkan form edit pengurus.
     */
    public function edit(Pengurus $pengurus)
    {
        return view('pengurus.edit', compact('pengurus'));
    }

    /**
     * Memperbarui data pengurus.
     */
    public function update(Request $request, Pengurus $pengurus)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'lembaga' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'periode' => 'nullable|string|max:100',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('foto')) {

            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('pengurus', 'public');
        }

        $pengurus->update($validated);

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil diperbarui.');
    }

    /**
     * Menghapus data pengurus.
     */
    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->delete();

        return redirect()
            ->route('pengurus.index')
            ->with('success', 'Data pengurus berhasil dihapus.');
    }
}