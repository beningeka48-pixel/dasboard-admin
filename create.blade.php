@extends('layouts.superadmin')

@section('title', 'Tambah User - KracakNu')

@section('page-title', 'Tambah User')

@section('page-description', 'Tambahkan akun pengguna baru ke sistem KracakNu')

@section('content')

<div class="container-fluid px-0">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-person-plus-fill"></i>
                Tambah User
            </h4>

            <p class="text-muted mb-0">
                Buat akun Admin atau Super Admin baru.
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

            <form action="{{ route('users.store') }}"
                  method="POST">

                @csrf


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
                           value="{{ old('name') }}"
                           placeholder="Masukkan nama lengkap"
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
                           value="{{ old('email') }}"
                           placeholder="contoh@email.com"
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

                        Password
                        <span class="text-danger">*</span>

                    </label>

                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Minimal 8 karakter"
                           required>

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

                        Konfirmasi Password
                        <span class="text-danger">*</span>

                    </label>

                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Ulangi password"
                           required>

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

                        <option value="">
                            -- Pilih Role --
                        </option>

                        {{-- ADMIN SELALU TERSEDIA --}}
                        <option value="admin"
                            {{ old('role') === 'admin' ? 'selected' : '' }}>

                            Admin

                        </option>


                        {{-- HANYA SUPER ADMIN UTAMA --}}
                        @if(auth()->user()->email === 'admin@kracaknu.test')

                            <option value="super_admin"
                                {{ old('role') === 'super_admin' ? 'selected' : '' }}>

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
                            Anda adalah Super Admin Utama dan dapat membuat
                            akun Super Admin.
                        </small>

                    @else

                        <small class="text-muted">
                            Sebagai Super Admin biasa, Anda hanya dapat
                            membuat akun Admin.
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

                        <option value="">
                            -- Pilih Status --
                        </option>

                        <option value="pending"
                            {{ old('status') === 'pending' ? 'selected' : '' }}>

                            Pending

                        </option>

                        <option value="approved"
                            {{ old('status') === 'approved' ? 'selected' : '' }}>

                            Approved

                        </option>

                        <option value="rejected"
                            {{ old('status') === 'rejected' ? 'selected' : '' }}>

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
                        Simpan User

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection