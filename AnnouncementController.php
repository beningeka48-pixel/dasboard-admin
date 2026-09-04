<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of announcements.
     */
    public function index()
    {
        $announcements = Announcement::latest()->get();

        return view('announcements.index', compact('announcements'));
    }


    /**
     * Show the form for creating a new announcement.
     */
    public function create()
    {
        return view('announcements.create');
    }


    /**
     * Store a newly created announcement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',

            'content' => 'required|string',

            'author' => 'required|string|max:255',

            'published_date' => 'nullable|date',

            'status' => 'required|in:published,draft',

            'address' => 'nullable|string|max:255',
        ]);


        Announcement::create($validated);


        return redirect()
            ->route('announcements.index')
            ->with('success', 'Announcement successfully added.');
    }


    /**
     * Display the specified announcement.
     */
    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }


    /**
     * Show the form for editing the specified announcement.
     */
    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }


    /**
     * Update the specified announcement.
     */
    public function update(
        Request $request,
        Announcement $announcement
    ) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',

            'content' => 'required|string',

            'author' => 'required|string|max:255',

            'published_date' => 'nullable|date',

            'status' => 'required|in:published,draft',

            'address' => 'nullable|string|max:255',
        ]);


        $announcement->update($validated);


        return redirect()
            ->route('announcements.index')
            ->with('success', 'Announcement successfully updated.');
    }


    /**
     * Remove the specified announcement.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();


        return redirect()
            ->route('announcements.index')
            ->with('success', 'Announcement successfully deleted.');
    }
}