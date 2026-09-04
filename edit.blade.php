@extends('layouts.superadmin')

@section('title', 'Edit User - KracakNu')

@section('page-title', 'Edit User')

@section('page-description', 'Perbarui informasi akun pengguna KracakNu')

@section('content')

<div class="container-fluid px-0">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-pencil-square"></i>
                Edit User
            </h4>

            <p class="text-muted mb-0">
                Mengubah data akun {{ $user->name }}.
            </p>
        </div>

        <a href="{{ route('users.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                <i class="bi bi-exclamation-triangle-fill"></i>
                Terdapat kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <h5 class="fw-bold mb-0">
                <i class="bi bi-person-vcard"></i>
                Informasi User
            </h5>

        </div>


        <div class="card-body">

            <form action="{{ route('users.update', $user->id) }}"
                  method="POST">

                @csrf
                @method('PUT')


                {{-- NAMA --}}
                <div class="mb-3">

                    <label for="name"
                           class="form-label fw-semibold">

                        Nama Lengkap
                        <span class="text-danger">*</span>

                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}"
                           required>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- EMAIL --}}
                <div class="mb-3">

                    <label for="email"
                           class="form-label fw-semibold">

                        Email
                        <span class="text-danger">*</span>

                    </label>

                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}"
                           required>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- PASSWORD --}}
                <div class="mb-3">

                    <label for="password"
                           class="form-label fw-semibold">

                        Password Baru

                    </label>

                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Kosongkan jika tidak ingin mengganti password">

                    <small class="text-muted">
                        Kosongkan jika password tidak ingin diubah.
                    </small>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- KONFIRMASI PASSWORD --}}
                <div class="mb-3">

                    <label for="password_confirmation"
                           class="form-label fw-semibold">

                        Konfirmasi Password Baru

                    </label>

                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Ulangi password baru">

                </div>


                {{-- ROLE --}}
                <div class="mb-3">

                    <label for="role"
                           class="form-label fw-semibold">

                        Role
                        <span class="text-danger">*</span>

                    </label>

                    <select id="role"
                            name="role"
                            class="form-select @error('role') is-invalid @enderror"
                            required>

                        {{-- ADMIN SELALU TERSEDIA --}}
                        <option value="admin"
                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>

                            Admin

                        </option>


                        {{-- SUPER ADMIN HANYA TERLIHAT BAGI SUPER ADMIN UTAMA --}}
                        @if(auth()->user()->email === 'admin@kracaknu.test')

                            <option value="super_admin"
                                {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>

                                Super Admin

                            </option>

                        @elseif($user->role === 'super_admin')

                            {{-- Agar Super Admin biasa tetap bisa melihat role akun --}}
                            <option value="super_admin"
                                    selected
                                    disabled>

                                Super Admin

                            </option>

                        @endif

                    </select>

                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror


                    @if(auth()->user()->email === 'admin@kracaknu.test')

                        <small class="text-muted">

                            Anda adalah Super Admin Utama.
                            Anda dapat mengatur role Super Admin.

                        </small>

                    @elseif($user->role === 'super_admin')

                        <small class="text-danger">

                            <i class="bi bi-shield-lock"></i>

                            Akun Super Admin hanya dapat dikelola
                            oleh Super Admin Utama.

                        </small>

                    @else

                        <small class="text-muted">

                            Anda hanya dapat memberikan role Admin.

                        </small>

                    @endif

                </div>


                {{-- STATUS --}}
                <div class="mb-4">

                    <label for="status"
                           class="form-label fw-semibold">

                        Status
                        <span class="text-danger">*</span>

                    </label>

                    <select id="status"
                            name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required>

                        <option value="pending"
                            {{ old('status', $user->status) === 'pending' ? 'selected' : '' }}>

                            Pending

                        </option>

                        <option value="approved"
                            {{ old('status', $user->status) === 'approved' ? 'selected' : '' }}>

                            Approved

                        </option>

                        <option value="rejected"
                            {{ old('status', $user->status) === 'rejected' ? 'selected' : '' }}>

                            Rejected

                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('users.index') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-x-circle"></i>
                        Batal

                    </a>

                    <button type="submit"
                            class="btn btn-success">

                        <i class="bi bi-save"></i>
                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection