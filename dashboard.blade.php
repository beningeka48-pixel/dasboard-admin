@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')

@section('page-title', 'Super Admin Dashboard')

@section('page-description', 'Welcome to KracakNu Super Admin')

@section('content')

<div class="row g-4">

    <div class="col-md-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold">
                    <i class="bi bi-shield-check"></i>
                    Super Admin
                </h5>

                <p class="text-muted mb-0">
                    You are logged in as Super Admin.
                </p>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold">
                    <i class="bi bi-people"></i>
                    User Management
                </h5>

                <p class="text-muted mb-0">
                    Manage administrator accounts.
                </p>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold">
                    <i class="bi bi-gear"></i>
                    System Settings
                </h5>

                <p class="text-muted mb-0">
                    Manage system configuration.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection