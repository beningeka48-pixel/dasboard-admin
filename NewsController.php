<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Menampilkan daftar berita.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'super_admin') {

            // Super Admin melihat semua berita
            $news = News::latest()->get();

        } else {

            // Admin hanya melihat berita miliknya
            $news = News::where('author', $user->name)
                        ->latest()
                        ->get();
        }

        return view('news.index', compact('news'));
    }


    /**
     * Form tambah berita.
     */
    public function create()
    {
        return view('news.create');
    }


    /**
     * Menyimpan berita baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'published_date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | AUTHOR
        |--------------------------------------------------------------------------
        */

        $validated['author'] = $user->name;


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        |
        | Super Admin -> langsung Published
        | Admin       -> Pending
        |
        */

        if ($user->role === 'super_admin') {

            $validated['status'] = 'published';

            // Jika tanggal kosong, gunakan tanggal hari ini
            if (empty($validated['published_date'])) {
                $validated['published_date'] = now()->toDateString();
            }

        } else {

            $validated['status'] = 'pending';
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD GAMBAR
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('news', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        News::create($validated);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'super_admin') {

            return redirect()
                ->route('news.index')
                ->with(
                    'success',
                    'News berhasil dibuat dan langsung diterbitkan.'
                );
        }

        return redirect()
            ->route('news.index')
            ->with(
                'success',
                'News berhasil dibuat dan menunggu persetujuan Super Admin.'
            );
    }


    /**
     * Menampilkan detail berita.
     */
    public function show(News $news)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | HAK AKSES
        |--------------------------------------------------------------------------
        |
        | Super Admin -> boleh melihat semua
        | Admin       -> hanya berita miliknya
        |
        */

        if (
            $user->role !== 'super_admin' &&
            $news->author !== $user->name
        ) {
            abort(403);
        }

        return view('news.show', compact('news'));
    }


    /**
     * Form edit berita.
     */
    public function edit(News $news)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | HAK AKSES
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'super_admin' &&
            $news->author !== $user->name
        ) {
            abort(403);
        }

        return view('news.edit', compact('news'));
    }


    /**
     * Update berita.
     */
    public function update(Request $request, News $news)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | HAK AKSES
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'super_admin' &&
            $news->author !== $user->name
        ) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'published_date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        |
        | Admin:
        | Setiap kali melakukan perubahan, berita kembali Pending.
        |
        | Super Admin:
        | Status yang ada tetap dipertahankan.
        |
        */

        if ($user->role === 'super_admin') {

            $validated['status'] = $news->status;

        } else {

            $validated['status'] = 'pending';
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD GAMBAR BARU
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('news', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $news->update($validated);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'super_admin') {

            return redirect()
                ->route('news.index')
                ->with(
                    'success',
                    'News berhasil diperbarui.'
                );
        }

        return redirect()
            ->route('news.index')
            ->with(
                'success',
                'News berhasil diperbarui dan dikirim kembali untuk persetujuan Super Admin.'
            );
    }


    /**
     * Menghapus berita.
     */
    public function destroy(News $news)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | HAK AKSES
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'super_admin' &&
            $news->author !== $user->name
        ) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS
        |--------------------------------------------------------------------------
        */

        $news->delete();


        return redirect()
            ->route('news.index')
            ->with(
                'success',
                'News berhasil dihapus.'
            );
    }


    /**
     * Menyetujui berita.
     *
     * HANYA SUPER ADMIN.
     */
    public function approve(News $news)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | CEK SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role !== 'super_admin') {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | HANYA PENDING YANG BOLEH DI-APPROVE
        |--------------------------------------------------------------------------
        */

        if ($news->status !== 'pending') {

            return redirect()
                ->route('news.index')
                ->with(
                    'error',
                    'News ini tidak sedang menunggu persetujuan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | APPROVE
        |--------------------------------------------------------------------------
        */

        $news->update([
            'status' => 'published',

            'published_date' => $news->published_date
                ?? now()->toDateString(),
        ]);


        return redirect()
            ->route('news.index')
            ->with(
                'success',
                'News berhasil disetujui dan diterbitkan.'
            );
    }


    /**
     * Menolak berita.
     *
     * HANYA SUPER ADMIN.
     */
    public function reject(News $news)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | CEK SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role !== 'super_admin') {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | HANYA PENDING YANG BOLEH DI-REJECT
        |--------------------------------------------------------------------------
        */

        if ($news->status !== 'pending') {

            return redirect()
                ->route('news.index')
                ->with(
                    'error',
                    'News ini tidak sedang menunggu persetujuan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | REJECT
        |--------------------------------------------------------------------------
        */

        $news->update([
            'status' => 'rejected',
        ]);


        return redirect()
            ->route('news.index')
            ->with(
                'success',
                'News berhasil ditolak.'
            );
    }
}