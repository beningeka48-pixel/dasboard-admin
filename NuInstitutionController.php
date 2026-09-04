<?php

namespace App\Http\Controllers;

use App\Models\NuInstitution;
use Illuminate\Http\Request;

class NuInstitutionController extends Controller
{
    /**
     * Menampilkan semua data NU Institutions.
     */
    public function index()
    {
        // Variabel disesuaikan menjadi $nuInstitutions dan view ke lembaga_nu.index
        $nuInstitutions = NuInstitution::latest()->get();

        return view('nu_institutions.index', compact('nuInstitutions'));
    }

    /**
     * Menampilkan halaman form tambah institution.
     */
    public function create()
    {
        return view('nu_institutions.create');
    }

    /**
     * Menyimpan data institution baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'leader'      => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'nullable|string|max:255',
            'phone'       => 'nullable|string|max:30',
            'status'      => 'required|in:active,inactive',
        ]);

        NuInstitution::create($validated);

        return redirect()
            ->route('nu-institutions.index')
            ->with('success', 'NU Institution successfully added.');
    }

    /**
     * Menampilkan detail institution.
     */
    public function show(NuInstitution $nuInstitution)
    {
        return view('nu_institutions.show', compact('nuInstitution'));
    }

    /**
     * Menampilkan form edit institution.
     */
    public function edit(NuInstitution $nuInstitution)
    {
        return view('nu_institutions.edit', compact('nuInstitution'));
    }

    /**
     * Memperbarui data institution.
     */
    public function update(Request $request, NuInstitution $nuInstitution)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'leader'      => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'nullable|string|max:255',
            'phone'       => 'nullable|string|max:30',
            'status'      => 'required|in:active,inactive',
        ]);

        $nuInstitution->update($validated);

        return redirect()
            ->route('nu-institutions.index')
            ->with('success', 'NU Institution successfully updated.');
    }

    /**
     * Menghapus institution.
     */
    public function destroy(NuInstitution $nuInstitution)
    {
        $nuInstitution->delete();

        return redirect()
            ->route('nu-institutions.index')
            ->with('success', 'NU Institution successfully deleted.');
    }
}