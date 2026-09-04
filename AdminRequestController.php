<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminRequestController extends Controller
{
    /**
     * Menampilkan daftar permintaan admin.
     */
    public function index()
    {
        // Hanya Super Admin yang boleh mengakses
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $users = User::where('role', 'admin')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.requests.index', compact('users'));
    }


    /**
     * Menyetujui akun admin.
     */
    public function approve(User $user)
    {
        // Hanya Super Admin
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user->update([
            'role' => 'admin',
            'status' => 'approved',
        ]);

        return back()->with(
            'success',
            'Admin account has been approved successfully.'
        );
    }


    /**
     * Menolak akun admin.
     */
    public function reject(User $user)
    {
        // Hanya Super Admin
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'Admin account has been rejected.'
        );
    }
}