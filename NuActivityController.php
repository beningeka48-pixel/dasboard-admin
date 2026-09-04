<?php

namespace App\Http\Controllers;

use App\Models\NuActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NuActivityController extends Controller
{
    /**
     * Menampilkan semua data NU Activities.
     */
    public function index()
    {
        $activities = NuActivity::latest()->get();

        return view('nu_activities.index', compact('activities'));
    }


    /**
     * Menampilkan form tambah NU Activity.
     */
    public function create()
    {
        return view('nu_activities.create');
    }


    /**
     * Menyimpan NU Activity baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'category' => 'nullable|string|max:100',

            'activity_date' => 'nullable|date',

            'location' => 'nullable|string|max:255',

            'organizer' => 'nullable|string|max:255',

            'status' => 'required|in:planned,ongoing,completed,cancelled',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        // Upload gambar jika ada
        if ($request->hasFile('image')) {

            $validated['image'] =
                $request->file('image')->store(
                    'nu-activities',
                    'public'
                );
        }


        NuActivity::create($validated);


        return redirect()
            ->route('nu_activities.index')
            ->with(
                'success',
                'NU Activity berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail NU Activity.
     */
    public function show(NuActivity $nuActivity)
    {
        return view(
            'nu_activities.show',
            compact('nuActivity')
        );
    }


    /**
     * Menampilkan form edit NU Activity.
     */
    public function edit(NuActivity $nuActivity)
    {
        return view(
            'nu_activities.edit',
            compact('nuActivity')
        );
    }


    /**
     * Memperbarui NU Activity.
     */
    public function update(
        Request $request,
        NuActivity $nuActivity
    ) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'category' => 'nullable|string|max:100',

            'activity_date' => 'nullable|date',

            'location' => 'nullable|string|max:255',

            'organizer' => 'nullable|string|max:255',

            'status' => 'required|in:planned,ongoing,completed,cancelled',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        // Jika ada gambar baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if (
                $nuActivity->image &&
                Storage::disk('public')->exists(
                    $nuActivity->image
                )
            ) {
                Storage::disk('public')->delete(
                    $nuActivity->image
                );
            }


            // Upload gambar baru
            $validated['image'] =
                $request->file('image')->store(
                    'nu-activities',
                    'public'
                );
        }


        $nuActivity->update($validated);


        return redirect()
            ->route(
                'nu_activities.show',
                $nuActivity->id
            )
            ->with(
                'success',
                'NU Activity berhasil diperbarui.'
            );
    }


    /**
     * Menghapus NU Activity.
     */
    public function destroy(NuActivity $nuActivity)
    {
        // Hapus gambar jika ada
        if (
            $nuActivity->image &&
            Storage::disk('public')->exists(
                $nuActivity->image
            )
        ) {
            Storage::disk('public')->delete(
                $nuActivity->image
            );
        }


        $nuActivity->delete();


        return redirect()
            ->route('nu_activities.index')
            ->with(
                'success',
                'NU Activity berhasil dihapus.'
            );
    }
}