<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles (blog).
     */
    public function index()
    {
        $articles = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('blog.index', compact('articles'));
    }

    /**
     * Display the specified article.
     */
    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment views
        $article->increment('views');

        // Get related articles
        $relatedArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Previous and Next articles
        $previousArticle = Article::where('status', 'published')
            ->where('created_at', '<', $article->created_at)
            ->orderBy('created_at', 'desc')
            ->first();

        $nextArticle = Article::where('status', 'published')
            ->where('created_at', '>', $article->created_at)
            ->orderBy('created_at', 'asc')
            ->first();

        return view('blog.show', compact('article', 'relatedArticles', 'previousArticle', 'nextArticle'));
    }
}
