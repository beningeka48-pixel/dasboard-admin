<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }


    /**
     * Memproses login.
     */
    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Login
        |--------------------------------------------------------------------------
        */

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Coba Login
        |--------------------------------------------------------------------------
        */

        if (!Auth::attempt($credentials)) {

            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->onlyInput('email');
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil User
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Cek Role
        |--------------------------------------------------------------------------
        |
        | Hanya Admin dan Super Admin yang boleh masuk
        | ke dashboard.
        |
        */

        if (!in_array($user->role, ['admin', 'super_admin'])) {

            Auth::logout();

            return back()
                ->withErrors([
                    'email' =>
                        'Anda tidak memiliki izin untuk mengakses dashboard.'
                ])
                ->onlyInput('email');
        }


        /*
        |--------------------------------------------------------------------------
        | Cek Status Akun
        |--------------------------------------------------------------------------
        */

        if ($user->status !== 'approved') {

            Auth::logout();

            if ($user->status === 'pending') {

                $message =
                    'Akun Anda masih menunggu persetujuan Super Admin.';

            } elseif ($user->status === 'rejected') {

                $message =
                    'Akun Anda ditolak oleh Super Admin.';

            } else {

                $message =
                    'Akun Anda belum aktif.';
            }

            return back()
                ->withErrors([
                    'email' => $message,
                ])
                ->onlyInput('email');
        }


        /*
        |--------------------------------------------------------------------------
        | Regenerate Session
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT BERDASARKAN ROLE
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'super_admin') {

            return redirect()->route('superadmin.dashboard');
        }


        if ($user->role === 'admin') {

            return redirect()->route('admin.dashboard');
        }


        /*
        |--------------------------------------------------------------------------
        | Jika Role Tidak Dikenali
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Role akun tidak dikenali.',
            ]);
    }


    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}