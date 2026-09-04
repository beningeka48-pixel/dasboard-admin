<?php

namespace App\Http\Controllers;


class SuperAdminController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();

    return view('superadmin.dashboard', compact('user'));
}
}
