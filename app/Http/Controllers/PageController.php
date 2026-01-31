<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Article;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        $featuredServices = Service::published()
            ->ordered()
            ->take(6)
            ->get();

        $latestArticles = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('pages.home', compact('featuredServices', 'latestArticles'));
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Handle contact form submission.
     */
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string|max:2000',
        ]);

        // Here you can add logic to send email or save to database

        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }

    /**
     * Search functionality.
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return view('pages.search', [
                'query' => $query,
                'services' => collect(),
                'articles' => collect(),
            ]);
        }

        $services = Service::published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('subtitle', 'like', "%{$query}%")
                  ->orWhere('overview', 'like', "%{$query}%");
            })
            ->ordered()
            ->take(10)
            ->get();

        $articles = Article::where('status', 'published')
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('pages.search', compact('query', 'services', 'articles'));
    }
}
