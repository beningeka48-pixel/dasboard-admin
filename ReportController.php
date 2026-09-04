<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of reports.
     */
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        | Super Admin dapat melihat semua laporan.
        */

        if ($user->role === 'super_admin') {

            $reports = Report::latest()->get();

        } else {

            /*
            |--------------------------------------------------------------------------
            | ADMIN BIASA
            |--------------------------------------------------------------------------
            | Admin hanya melihat laporan yang dibuat olehnya.
            |
            | Karena kolom author pada tabel reports berupa nama,
            | kita cocokkan dengan nama user yang sedang login.
            */

            $reports = Report::where('author', $user->name)
                ->latest()
                ->get();
        }

        return view('reports.index', compact('reports'));
    }


    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        return view('reports.create');
    }


    /**
     * Store a newly created report.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'report_date' => 'nullable|date',
            'category'    => 'nullable|string|max:255',
            'status'      => 'required|in:published,draft',
            'address'     => 'nullable|string|max:255',
        ]);


        /*
        |--------------------------------------------------------------------------
        | AUTHOR OTOMATIS
        |--------------------------------------------------------------------------
        | Nama pembuat laporan diambil dari user yang sedang login.
        */

        $validated['author'] = auth()->user()->name;


        Report::create($validated);


        return redirect()
            ->route('reports.index')
            ->with(
                'success',
                'Laporan berhasil dibuat dan tersimpan.'
            );
    }


    /**
     * Display the specified report.
     */
    public function show(Report $report)
    {
        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | PERMISSION
        |--------------------------------------------------------------------------
        | Super Admin boleh melihat semua laporan.
        |
        | Admin biasa hanya boleh melihat laporan miliknya.
        */

        if (
            $user->role !== 'super_admin' &&
            $report->author !== $user->name
        ) {

            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }


        return view(
            'reports.show',
            compact('report')
        );
    }


    /**
     * Show the form for editing the specified report.
     */
    public function edit(Report $report)
    {
        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | PERMISSION
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'super_admin' &&
            $report->author !== $user->name
        ) {

            abort(403, 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }


        return view(
            'reports.edit',
            compact('report')
        );
    }


    /**
     * Update the specified report.
     */
    public function update(
        Request $request,
        Report $report
    ) {

        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | PERMISSION
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'super_admin' &&
            $report->author !== $user->name
        ) {

            abort(403, 'Anda tidak memiliki akses untuk mengubah laporan ini.');
        }


        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'report_date' => 'nullable|date',
            'category'    => 'nullable|string|max:255',
            'status'      => 'required|in:published,draft',
            'address'     => 'nullable|string|max:255',
        ]);


        /*
        |--------------------------------------------------------------------------
        | AUTHOR TETAP
        |--------------------------------------------------------------------------
        | Nama pembuat laporan tidak ikut diubah ketika laporan diedit.
        */

        $report->update($validated);


        return redirect()
            ->route('reports.index')
            ->with(
                'success',
                'Laporan berhasil diperbarui.'
            );
    }


    /**
     * Remove the specified report.
     */
    public function destroy(Report $report)
    {
        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | PERMISSION
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'super_admin' &&
            $report->author !== $user->name
        ) {

            abort(403, 'Anda tidak memiliki akses untuk menghapus laporan ini.');
        }


        $report->delete();


        return redirect()
            ->route('reports.index')
            ->with(
                'success',
                'Laporan berhasil dihapus.'
            );
    }
}