@extends('layouts.superadmin')

@section('title', 'Detail User - KracakNu')

@section('page-title', 'Detail User')

@section('page-description', 'Informasi lengkap akun pengguna KracakNu')

@section('content')

<div class="container-fluid px-0">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-person-vcard-fill"></i>
                Detail User
            </h4>

            <p class="text-muted mb-0">
                Informasi lengkap pengguna {{ $user->name }}.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('users.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>

            <a href="{{ route('users.edit', $user->id) }}"
               class="btn btn-primary">

                <i class="bi bi-pencil-square"></i>
                Edit

            </a>

        </div>

    </div>


    {{-- USER PROFILE --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body p-4">

            <div class="row align-items-center">

                {{-- AVATAR --}}
                <div class="col-md-3 text-center">

                    <div class="rounded-circle
                                bg-success
                                text-white
                                d-flex
                                align-items-center
                                justify-content-center
                                mx-auto"
                         style="width:110px;height:110px;font-size:45px;">

                        {{ strtoupper(substr($user->name, 0, 1)) }}

                    </div>

                    <h5 class="fw-bold mt-3 mb-1">
                        {{ $user->name }}
                    </h5>

                    <small class="text-muted">
                        {{ $user->email }}
                    </small>

                </div>


                {{-- INFORMATION --}}
                <div class="col-md-9">

                    <div class="row g-4">

                        {{-- NAME --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Nama Lengkap
                            </small>

                            <strong>
                                {{ $user->name }}
                            </strong>

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Email
                            </small>

                            <strong>
                                {{ $user->email }}
                            </strong>

                        </div>


                        {{-- ROLE --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Role
                            </small>

                            @if($user->role === 'super_admin')

                                <span class="badge bg-warning text-dark">

                                    <i class="bi bi-shield-fill-check"></i>
                                    Super Admin

                                </span>

                            @else

                                <span class="badge bg-primary">

                                    <i class="bi bi-person-badge"></i>
                                    Admin

                                </span>

                            @endif

                        </div>


                        {{-- STATUS --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Status
                            </small>

                            @if($user->status === 'approved')

                                <span class="badge bg-success">

                                    <i class="bi bi-check-circle-fill"></i>
                                    Approved

                                </span>

                            @elseif($user->status === 'pending')

                                <span class="badge bg-warning text-dark">

                                    <i class="bi bi-clock-fill"></i>
                                    Pending

                                </span>

                            @elseif($user->status === 'rejected')

                                <span class="badge bg-danger">

                                    <i class="bi bi-x-circle-fill"></i>
                                    Rejected

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    {{ ucfirst($user->status) }}

                                </span>

                            @endif

                        </div>


                        {{-- CREATED --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Tanggal Dibuat
                            </small>

                            <strong>

                                {{ $user->created_at?->format('d F Y, H:i') }}

                            </strong>

                        </div>


                        {{-- UPDATED --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Terakhir Diperbarui
                            </small>

                            <strong>

                                {{ $user->updated_at?->format('d F Y, H:i') }}

                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- SUPER ADMIN INFORMATION --}}
    @if($user->email === 'admin@kracaknu.test')

        <div class="alert alert-warning border-0 shadow-sm">

            <div class="d-flex">

                <div class="fs-4 me-3">

                    <i class="bi bi-shield-lock-fill"></i>

                </div>

                <div>

                    <h6 class="fw-bold mb-1">
                        Super Admin Utama
                    </h6>

                    <p class="mb-0">

                        Akun ini merupakan Super Admin Utama
                        sistem KracakNu. Akun ini memiliki hak
                        akses tertinggi dan tidak dapat dihapus
                        melalui User Management.

                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- ACTION CARD --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h5 class="fw-bold mb-3">

                <i class="bi bi-gear-fill"></i>
                Pengelolaan Akun

            </h5>


            <div class="d-flex flex-wrap gap-2">

                {{-- EDIT --}}
                <a href="{{ route('users.edit', $user->id) }}"
                   class="btn btn-primary">

                    <i class="bi bi-pencil-square"></i>
                    Edit User

                </a>


                {{-- APPROVE --}}
                @if($user->status === 'pending')

                    <form action="{{ route('users.approve', $user->id) }}"
                          method="POST">

                        @csrf
                        @method('PATCH')

                        <button type="submit"
                                class="btn btn-success"
                                onclick="return confirm('Apakah Anda yakin ingin menyetujui user ini?')">

                            <i class="bi bi-check-circle"></i>
                            Approve

                        </button>

                    </form>

                @endif


                {{-- REJECT --}}
                @if(
                    $user->status !== 'rejected'
                    &&
                    $user->email !== 'admin@kracaknu.test'
                )

                    <form action="{{ route('users.reject', $user->id) }}"
                          method="POST">

                        @csrf
                        @method('PATCH')

                        <button type="submit"
                                class="btn btn-warning"
                                onclick="return confirm('Apakah Anda yakin ingin menolak user ini?')">

                            <i class="bi bi-x-circle"></i>
                            Reject

                        </button>

                    </form>

                @endif


                {{-- DELETE --}}
                @if(
                    auth()->id() !== $user->id
                    &&
                    $user->email !== 'admin@kracaknu.test'
                )

                    <form action="{{ route('users.destroy', $user->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini? Data yang dihapus tidak dapat dikembalikan.')">

                            <i class="bi bi-trash"></i>
                            Hapus User

                        </button>

                    </form>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection