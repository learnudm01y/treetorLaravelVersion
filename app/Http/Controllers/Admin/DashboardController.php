<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Real Statistics
        $stats = [
            'total_users' => User::count(),
            'total_articles' => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'draft_articles' => Article::where('status', 'draft')->count(),
            'total_services' => Service::count(),
            'published_services' => Service::where('status', 'published')->count(),
            'draft_services' => Service::where('status', 'draft')->count(),
        ];

        // Recent Articles with view count
        $recent_articles = Article::orderBy('created_at', 'desc')
            ->take(5)
            ->get(['id', 'title', 'slug', 'status', 'views', 'created_at']);

        // Recent Services
        $recent_services = Service::orderBy('created_at', 'desc')
            ->take(5)
            ->get(['id', 'title', 'slug', 'status', 'created_at']);

        // Most viewed articles
        $popular_articles = Article::where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get(['id', 'title', 'slug', 'views']);

        return view('admin.dashboard', compact('stats', 'recent_articles', 'recent_services', 'popular_articles'));
    }
}
