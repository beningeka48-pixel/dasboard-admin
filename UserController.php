<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN UTAMA
    |--------------------------------------------------------------------------
    |
    | Untuk sementara akun ini menjadi Super Admin Utama.
    | Hanya akun ini yang boleh membuat atau memberikan role
    | Super Admin kepada user lain.
    |
    */

    private const MAIN_SUPER_ADMIN_EMAIL = 'admin@kracaknu.test';


    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    |
    | Menampilkan semua user.
    |
    */

    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    |
    | Menampilkan form tambah user.
    |
    */

    public function create()
    {
        return view('users.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    |
    | Menyimpan user baru.
    |
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                'in:admin,super_admin',
            ],

            'status' => [
                'required',
                'in:pending,approved,rejected',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pembatasan Super Admin
        |--------------------------------------------------------------------------
        |
        | Hanya Super Admin Utama yang boleh membuat
        | akun dengan role super_admin.
        |
        */

        if (
            $validated['role'] === 'super_admin'
            &&
            auth()->user()->email !== self::MAIN_SUPER_ADMIN_EMAIL
        ) {

            return back()
                ->withErrors([
                    'role' =>
                        'Hanya Super Admin Utama yang dapat membuat akun Super Admin.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan User
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => Hash::make(
                $validated['password']
            ),

            'role' => $validated['role'],

            'status' => $validated['status'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    |
    | Menampilkan detail user.
    |
    */

    public function show(User $user)
    {
        return view(
            'users.show',
            compact('user')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    |
    | Menampilkan form edit user.
    |
    */

    public function edit(User $user)
    {
        return view(
            'users.edit',
            compact('user')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    |
    | Memperbarui data user.
    |
    */

    public function update(
        Request $request,
        User $user
    ) {

        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                'in:admin,super_admin',
            ],

            'status' => [
                'required',
                'in:pending,approved,rejected',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Cek perubahan role menjadi Super Admin
        |--------------------------------------------------------------------------
        |
        | Hanya Super Admin Utama yang boleh memberikan
        | role super_admin.
        |
        */

        if (
            $validated['role'] === 'super_admin'
            &&
            auth()->user()->email !== self::MAIN_SUPER_ADMIN_EMAIL
            &&
            $user->role !== 'super_admin'
        ) {

            return back()
                ->withErrors([
                    'role' =>
                        'Hanya Super Admin Utama yang dapat memberikan role Super Admin.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Cegah Super Admin biasa mengubah Super Admin
        |--------------------------------------------------------------------------
        |
        | Super Admin biasa tidak boleh mengubah role
        | Super Admin lain.
        |
        */

        if (
            $user->role === 'super_admin'
            &&
            auth()->user()->email !== self::MAIN_SUPER_ADMIN_EMAIL
            &&
            auth()->id() !== $user->id
        ) {

            return back()
                ->withErrors([
                    'role' =>
                        'Anda tidak memiliki izin untuk mengubah akun Super Admin.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Cegah user menurunkan role dirinya sendiri
        |--------------------------------------------------------------------------
        */

        if (
            auth()->id() === $user->id
            &&
            $validated['role'] !== 'super_admin'
        ) {

            return back()
                ->withErrors([
                    'role' =>
                        'Anda tidak dapat mengubah role akun Super Admin Anda sendiri.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Update Data
        |--------------------------------------------------------------------------
        */

        $user->name = $validated['name'];

        $user->email = $validated['email'];

        $user->role = $validated['role'];

        $user->status = $validated['status'];


        /*
        |--------------------------------------------------------------------------
        | Update Password
        |--------------------------------------------------------------------------
        |
        | Password hanya diubah jika field diisi.
        |
        */

        if (!empty($validated['password'])) {

            $user->password = Hash::make(
                $validated['password']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan
        |--------------------------------------------------------------------------
        */

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Data user berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    |
    | Menghapus user.
    |
    */

    public function destroy(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | Tidak boleh menghapus akun sendiri
        |--------------------------------------------------------------------------
        */

        if (auth()->id() === $user->id) {

            return back()
                ->with(
                    'error',
                    'Anda tidak dapat menghapus akun sendiri.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Super Admin Utama tidak boleh dihapus
        |--------------------------------------------------------------------------
        */

        if (
            $user->email === self::MAIN_SUPER_ADMIN_EMAIL
        ) {

            return back()
                ->with(
                    'error',
                    'Akun Super Admin Utama tidak dapat dihapus.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus User
        |--------------------------------------------------------------------------
        */

        $user->delete();


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVE
    |--------------------------------------------------------------------------
    |
    | Menyetujui akun user.
    |
    */

    public function approve(User $user)
    {
        $user->update([
            'status' => 'approved',
        ]);

        return back()
            ->with(
                'success',
                'User berhasil disetujui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | REJECT
    |--------------------------------------------------------------------------
    |
    | Menolak akun user.
    |
    */

    public function reject(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | Super Admin Utama tidak boleh ditolak
        |--------------------------------------------------------------------------
        */

        if (
            $user->email === self::MAIN_SUPER_ADMIN_EMAIL
        ) {

            return back()
                ->with(
                    'error',
                    'Super Admin Utama tidak dapat ditolak.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Reject User
        |--------------------------------------------------------------------------
        */

        $user->update([
            'status' => 'rejected',
        ]);


        return back()
            ->with(
                'success',
                'User berhasil ditolak.'
            );
    }
}