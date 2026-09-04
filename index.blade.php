@extends('layouts.superadmin')

@section('title', 'User Management - KracakNu')

@section('page-title', 'User Management')

@section('page-description', 'Kelola akun Admin dan Super Admin KracakNu')

@section('content')

<div class="container-fluid px-0">

    {{-- =========================
         HEADER
    ========================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-people-fill"></i>
                User Management
            </h4>

            <p class="text-muted mb-0">
                Kelola pengguna yang memiliki akses ke sistem KracakNu.
            </p>
        </div>

        <a href="{{ route('users.create') }}"
           class="btn btn-success">

            <i class="bi bi-person-plus-fill"></i>
            Tambah User

        </a>

    </div>


    {{-- =========================
         SUCCESS MESSAGE
    ========================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================
         ERROR MESSAGE
    ========================== --}}

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">

            <i class="bi bi-exclamation-triangle-fill"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================
         VALIDATION ERROR
    ========================== --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                <i class="bi bi-exclamation-triangle-fill"></i>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================
         STATISTICS
    ========================== --}}

    <div class="row g-3 mb-4">

        {{-- TOTAL USER --}}
        <div class="col-md-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Total User
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $users->count() }}
                            </h3>

                        </div>

                        <div class="fs-2 text-primary">
                            <i class="bi bi-people-fill"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ADMIN --}}
        <div class="col-md-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Admin
                            </p>

                            <h3 class="fw-bold mb-0">

                                {{ $users->where('role', 'admin')->count() }}

                            </h3>

                        </div>

                        <div class="fs-2 text-success">

                            <i class="bi bi-person-badge-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- SUPER ADMIN --}}
        <div class="col-md-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Super Admin
                            </p>

                            <h3 class="fw-bold mb-0">

                                {{ $users->where('role', 'super_admin')->count() }}

                            </h3>

                        </div>

                        <div class="fs-2 text-warning">

                            <i class="bi bi-shield-fill-check"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PENDING --}}
        <div class="col-md-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Menunggu Persetujuan
                            </p>

                            <h3 class="fw-bold mb-0">

                                {{ $users->where('status', 'pending')->count() }}

                            </h3>

                        </div>

                        <div class="fs-2 text-danger">

                            <i class="bi bi-hourglass-split"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         USER TABLE
    ========================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">

                        <i class="bi bi-person-lines-fill"></i>
                        Daftar Pengguna

                    </h5>

                    <small class="text-muted">

                        Daftar seluruh akun yang terdaftar.

                    </small>

                </div>

                <span class="badge bg-secondary">

                    {{ $users->count() }} User

                </span>

            </div>

        </div>


        <div class="card-body p-0">

            @if($users->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-4">
                                    #
                                </th>

                                <th>
                                    User
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Role
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Dibuat
                                </th>

                                <th class="text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($users as $index => $user)

                                <tr>

                                    {{-- NOMOR --}}
                                    <td class="px-4 fw-semibold">

                                        {{ $index + 1 }}

                                    </td>


                                    {{-- USER --}}
                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="rounded-circle
                                                        bg-success
                                                        text-white
                                                        d-flex
                                                        align-items-center
                                                        justify-content-center"
                                                 style="width:42px;height:42px;">

                                                {{ strtoupper(substr($user->name, 0, 1)) }}

                                            </div>

                                            <div class="ms-3">

                                                <div class="fw-semibold">

                                                    {{ $user->name }}

                                                </div>

                                                @if($user->email === 'admin@kracaknu.test')

                                                    <small class="text-warning">

                                                        <i class="bi bi-star-fill"></i>
                                                        Super Admin Utama

                                                    </small>

                                                @endif

                                            </div>

                                        </div>

                                    </td>


                                    {{-- EMAIL --}}
                                    <td>

                                        <span>

                                            {{ $user->email }}

                                        </span>

                                    </td>


                                    {{-- ROLE --}}
                                    <td>

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

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if($user->status === 'approved')

                                            <span class="badge bg-success">

                                                <i class="bi bi-check-circle"></i>

                                                Approved

                                            </span>

                                        @elseif($user->status === 'pending')

                                            <span class="badge bg-warning text-dark">

                                                <i class="bi bi-clock"></i>

                                                Pending

                                            </span>

                                        @elseif($user->status === 'rejected')

                                            <span class="badge bg-danger">

                                                <i class="bi bi-x-circle"></i>

                                                Rejected

                                            </span>

                                        @else

                                            <span class="badge bg-secondary">

                                                {{ ucfirst($user->status) }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- CREATED --}}
                                    <td>

                                        <small class="text-muted">

                                            {{ $user->created_at?->format('d M Y') }}

                                        </small>

                                    </td>


                                    {{-- ACTION --}}
                                    <td>

                                        <div class="d-flex
                                                    justify-content-center
                                                    gap-1">

                                            {{-- SHOW --}}
                                            <a href="{{ route('users.show', $user->id) }}"
                                               class="btn btn-sm btn-outline-info"
                                               title="Lihat Detail">

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- EDIT --}}
                                            <a href="{{ route('users.edit', $user->id) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Edit User">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- APPROVE --}}
                                            @if($user->status === 'pending')

                                                <form action="{{ route('users.approve', $user->id) }}"
                                                      method="POST"
                                                      class="d-inline">

                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-success"
                                                            title="Approve"
                                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui user ini?')">

                                                        <i class="bi bi-check-lg"></i>

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
                                                      method="POST"
                                                      class="d-inline">

                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-warning"
                                                            title="Reject"
                                                            onclick="return confirm('Apakah Anda yakin ingin menolak user ini?')">

                                                        <i class="bi bi-x-lg"></i>

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
                                                      method="POST"
                                                      class="d-inline">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="Hapus User"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini? Data yang dihapus tidak dapat dikembalikan.')">

                                                        <i class="bi bi-trash"></i>

                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                {{-- EMPTY STATE --}}

                <div class="text-center py-5">

                    <div class="display-4 text-muted mb-3">

                        <i class="bi bi-people"></i>

                    </div>

                    <h5 class="fw-bold">
                        Belum Ada User
                    </h5>

                    <p class="text-muted">

                        Belum ada pengguna yang terdaftar
                        di sistem KracakNu.

                    </p>

                    <a href="{{ route('users.create') }}"
                       class="btn btn-success">

                        <i class="bi bi-person-plus"></i>

                        Tambah User

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>


@endsection