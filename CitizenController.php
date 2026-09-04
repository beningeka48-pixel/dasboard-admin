<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citizens = Citizen::all();

        return view('citizens.index', compact('citizens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('citizens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:citizens,nik',
            'name' => 'required|max:255',
            'gender' => 'required|in:Male,Female',
            'birth_place' => 'required|max:255',
            'birth_date' => 'required|date',
            'address' => 'required',
            'phone_number' => 'nullable|max:20',
            'occupation' => 'nullable|max:255',
            'religion' => 'nullable|max:100',
            'marital_status' => 'nullable|max:100',
        ]);

        Citizen::create($request->all());

        return redirect()
            ->route('citizens.index')
            ->with('success', 'Citizen successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Citizen $citizen)
    {
        return view('citizens.show', compact('citizen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citizen $citizen)
    {
        return view('citizens.edit', compact('citizen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citizen $citizen)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:citizens,nik,' . $citizen->id,
            'name' => 'required|max:255',
            'gender' => 'required|in:Male,Female',
            'birth_place' => 'required|max:255',
            'birth_date' => 'required|date',
            'address' => 'required',
            'phone_number' => 'nullable|max:20',
            'occupation' => 'nullable|max:255',
            'religion' => 'nullable|max:100',
            'marital_status' => 'nullable|max:100',
        ]);

        $citizen->update($request->all());

        return redirect()
            ->route('citizens.index')
            ->with('success', 'Citizen successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citizen $citizen)
    {
        $citizen->delete();

        return redirect()
            ->route('citizens.index')
            ->with('success', 'Citizen successfully deleted!');
    }
}
