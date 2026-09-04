<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\News;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Total citizens
        $totalCitizens = Citizen::count();

        // Total news
        $totalNews = News::count();

        // Published news
        $publishedNews = News::where('status', 'published')->count();

        // Draft news
        $draftNews = News::where('status', 'draft')->count();

        // Latest news
        $latestNews = News::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalCitizens',
            'totalNews',
            'publishedNews',
            'draftNews',
            'latestNews'
        ));
    }
}