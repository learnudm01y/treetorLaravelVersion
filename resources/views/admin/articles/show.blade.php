@extends('layouts.admin')

@section('title', $article->title)

@section('content')
    {{-- Page Header --}}
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.articles.index') }}"
                   class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">View Article</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Article details and preview</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.articles.edit', $article) }}"
                   class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.articles.destroy', $article) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this article?');"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-100 dark:border-red-800 dark:bg-red-900/20 dark:text-red-400">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        {{-- Main Content --}}
        <div class="col-span-12 xl:col-span-8">
            {{-- Featured Image --}}
            @if($article->featured_image)
                <div class="mb-6 rounded-2xl overflow-hidden">
                    <img src="{{ Storage::url($article->featured_image) }}"
                         alt="{{ $article->title }}"
                         class="w-full h-64 object-cover">
                </div>
            @endif

            {{-- Article Content --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white/90 mb-4">{{ $article->title }}</h1>

                @if($article->excerpt)
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6 pb-6 border-b border-gray-200 dark:border-gray-800">
                        {{ $article->excerpt }}
                    </p>
                @endif

                <div class="prose prose-lg max-w-none dark:prose-invert">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-span-12 xl:col-span-4">
            {{-- Article Info --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                <h3 class="mb-4 text-lg font-medium text-gray-800 dark:text-white/90">Article Information</h3>

                <div class="space-y-4">
                    {{-- Status --}}
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Status</span>
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $article->status_badge }}">
                            {{ ucfirst($article->status) }}
                        </span>
                    </div>

                    {{-- Author --}}
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Author</span>
                        <div class="flex items-center gap-2">
                            <div class="h-6 w-6 rounded-full bg-brand-100 dark:bg-brand-900 flex items-center justify-center">
                                <span class="text-xs font-medium text-brand-600 dark:text-brand-400">{{ substr($article->user->name ?? 'A', 0, 1) }}</span>
                            </div>
                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $article->user->name ?? 'Unknown' }}</span>
                        </div>
                    </div>

                    {{-- Views --}}
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Views</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ number_format($article->views) }}</span>
                    </div>

                    {{-- Created --}}
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Created</span>
                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $article->created_at->format('M d, Y') }}</span>
                    </div>

                    {{-- Updated --}}
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Last Updated</span>
                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $article->updated_at->format('M d, Y') }}</span>
                    </div>

                    @if($article->published_at)
                    {{-- Published --}}
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Published</span>
                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $article->published_at->format('M d, Y') }}</span>
                    </div>
                    @endif

                    {{-- Slug --}}
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-800">
                        <span class="text-sm text-gray-500 dark:text-gray-400 block mb-1">Slug</span>
                        <code class="text-sm text-brand-600 dark:text-brand-400 bg-brand-50 dark:bg-brand-900/20 px-2 py-1 rounded">{{ $article->slug }}</code>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                <h3 class="mb-4 text-lg font-medium text-gray-800 dark:text-white/90">Quick Actions</h3>

                <div class="space-y-3">
                    <a href="{{ route('admin.articles.edit', $article) }}"
                       class="flex items-center gap-3 w-full rounded-lg p-3 text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit Article
                    </a>
                    <a href="{{ route('admin.articles.create') }}"
                       class="flex items-center gap-3 w-full rounded-lg p-3 text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Create New Article
                    </a>
                    <a href="{{ route('admin.articles.index') }}"
                       class="flex items-center gap-3 w-full rounded-lg p-3 text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Back to Articles
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
