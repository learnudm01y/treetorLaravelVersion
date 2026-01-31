@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Dashboard</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Welcome back, {{ Auth::user()->name ?? 'Admin' }}!</p>
    </div>

    {{-- Metrics Cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 md:gap-6">
        {{-- Total Users --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-brand-50 dark:bg-brand-500/10">
                    <svg class="w-6 h-6 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
            </div>
            <div class="mt-5">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ number_format($stats['total_users']) }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
            </div>
        </div>

        {{-- Total Articles --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-cyan-50 dark:bg-cyan-500/10">
                    <svg class="w-6 h-6 text-cyan-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/>
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-600 dark:bg-green-500/10 dark:text-green-400">
                    {{ $stats['published_articles'] }} Published
                </span>
            </div>
            <div class="mt-5">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ number_format($stats['total_articles']) }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Articles</p>
            </div>
        </div>

        {{-- Total Services --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-green-50 dark:bg-green-500/10">
                    <svg class="w-6 h-6 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                        <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-600 dark:bg-green-500/10 dark:text-green-400">
                    {{ $stats['published_services'] }} Published
                </span>
            </div>
            <div class="mt-5">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ number_format($stats['total_services']) }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Services</p>
            </div>
        </div>

        {{-- Article Views --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-500/10">
                    <svg class="w-6 h-6 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </div>
            </div>
            <div class="mt-5">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ number_format($popular_articles->sum('views')) }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Article Views</p>
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="mt-6 grid grid-cols-12 gap-4 md:gap-6">
        {{-- Recent Articles --}}
        <div class="col-span-12 xl:col-span-7">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 md:px-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Recent Articles</h3>
                </div>
                <div class="p-5 md:p-6">
                    @if($recent_articles->count() > 0)
                        <div class="space-y-4">
                            @foreach($recent_articles as $article)
                                <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <div class="flex-1">
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="text-sm font-medium text-gray-800 dark:text-white/90 hover:text-brand-500">
                                            {{ $article->title }}
                                        </a>
                                        <div class="flex items-center gap-3 mt-1">
                                            <span class="text-xs text-gray-500">{{ $article->created_at->diffForHumans() }}</span>
                                            <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                    <circle cx="12" cy="12" r="3"/>
                                                </svg>
                                                {{ number_format($article->views) }}
                                            </span>
                                        </div>
                                    </div>
                                    <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium
                                        {{ $article->status === 'published' ? 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400' : 'bg-yellow-50 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400' }}">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-400 dark:text-gray-600">
                            <svg class="w-12 h-12 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/>
                            </svg>
                            <p>No articles yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Popular Articles --}}
        <div class="col-span-12 xl:col-span-5">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 md:px-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Most Viewed Articles</h3>
                </div>
                <div class="p-5 md:p-6">
                    @if($popular_articles->count() > 0)
                        <div class="space-y-3">
                            @foreach($popular_articles as $index => $article)
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-brand-50 dark:bg-brand-500/10 text-brand-500 font-semibold text-sm flex-shrink-0">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="text-sm font-medium text-gray-800 dark:text-white/90 hover:text-brand-500 block truncate">
                                            {{ $article->title }}
                                        </a>
                                        <span class="inline-flex items-center gap-1 text-xs text-gray-500 mt-0.5">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                            {{ number_format($article->views) }} views
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-400 dark:text-gray-600">
                            <p class="text-sm">No published articles yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Services Table --}}
    <div class="mt-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 md:px-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Recent Services</h3>
            </div>
            <div class="overflow-x-auto">
                @if($recent_services->count() > 0)
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 md:px-6">Service</th>
                                <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 md:px-6">Slug</th>
                                <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 md:px-6">Status</th>
                                <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 md:px-6">Created</th>
                                <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 md:px-6">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                            @foreach($recent_services as $service)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                    <td class="px-5 py-4 md:px-6">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $service->title }}</span>
                                    </td>
                                    <td class="px-5 py-4 text-sm text-gray-500 dark:text-gray-400 md:px-6">{{ $service->slug }}</td>
                                    <td class="px-5 py-4 md:px-6">
                                        <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium
                                            {{ $service->status === 'published' ? 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400' :
                                               ($service->status === 'draft' ? 'bg-yellow-50 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400' :
                                               'bg-gray-50 text-gray-600 dark:bg-gray-500/10 dark:text-gray-400') }}">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-sm text-gray-500 dark:text-gray-400 md:px-6">{{ $service->created_at->format('M d, Y') }}</td>
                                    <td class="px-5 py-4 md:px-6">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="text-sm text-brand-500 hover:text-brand-600 font-medium">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-12 text-gray-400 dark:text-gray-600">
                        <svg class="w-12 h-12 mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                            <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>
                        </svg>
                        <p>No services yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
