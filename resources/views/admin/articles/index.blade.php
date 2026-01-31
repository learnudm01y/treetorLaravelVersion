@extends('layouts.admin')

@section('title', 'Articles')

@section('content')
    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Articles</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Manage your blog articles</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                    <path d="M22 4L12 14.01l-3-3"/>
                </svg>
                <p class="text-sm text-green-700 dark:text-green-400">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- Toolbar: Search + Filter + Add Button --}}
    <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
        <form action="{{ route('admin.articles.index') }}" method="GET" class="flex items-center gap-4">
            {{-- Search Input (icon on right, inside the field) --}}
            <div class="relative inline-flex">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search articles..."
                       class="w-64 rounded-lg border border-gray-200 bg-white pl-4 pr-12 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                <button type="button" class="absolute inset-y-0 right-0 flex items-center justify-center w-10 text-gray-400 pointer-events-none" style="padding-top: 10px;">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                </button>
            </div>

            {{-- Custom Select for Status --}}
            <div x-data="{ open: false, selected: '{{ request('status', 'all') }}' }" class="relative">
                <button type="button"
                        @click="open = !open"
                        @click.away="open = false"
                        class="flex items-center justify-between gap-2 w-44 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 hover:bg-gray-50 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90 dark:hover:bg-gray-800">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full" :class="selected === 'all' ? 'bg-gray-400' : selected === 'published' ? 'bg-green-500' : selected === 'draft' ? 'bg-yellow-500' : 'bg-gray-500'"></span>
                        <span x-text="selected === 'all' ? 'All Status' : selected === 'published' ? 'Published' : selected === 'draft' ? 'Draft' : 'Archived'"></span>
                    </div>
                    <svg class="w-4 h-4 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </button>
                <input type="hidden" name="status" :value="selected">

                {{-- Dropdown Menu --}}
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute left-0 z-20 mt-2 w-44 rounded-lg border border-gray-200 bg-white py-1 shadow-lg dark:border-gray-800 dark:bg-gray-900">
                    <button type="button" @click="selected = 'all'; open = false"
                            class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                            :class="{ 'bg-brand-50 text-brand-600 dark:bg-brand-900/20': selected === 'all' }">
                        <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                        All Status
                    </button>
                    <button type="button" @click="selected = 'published'; open = false"
                            class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                            :class="{ 'bg-brand-50 text-brand-600 dark:bg-brand-900/20': selected === 'published' }">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        Published
                    </button>
                    <button type="button" @click="selected = 'draft'; open = false"
                            class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                            :class="{ 'bg-brand-50 text-brand-600 dark:bg-brand-900/20': selected === 'draft' }">
                        <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                        Draft
                    </button>
                    <button type="button" @click="selected = 'archived'; open = false"
                            class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800"
                            :class="{ 'bg-brand-50 text-brand-600 dark:bg-brand-900/20': selected === 'archived' }">
                        <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                        Archived
                    </button>
                </div>
            </div>

            {{-- Filter Button --}}
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 transition-colors">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                Filter
            </button>

            {{-- Spacer to push Add button to far right --}}
            <div class="flex-1"></div>

            {{-- Add New Article Button (far right) --}}
            <a href="{{ route('admin.articles.create') }}"
               class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 transition-colors whitespace-nowrap">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Add New Article
            </a>
        </form>
    </div>

    {{-- Articles Table --}}
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-800">
                        <th class="px-5 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Article</th>
                        <th class="px-5 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Author</th>
                        <th class="px-5 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Status</th>
                        <th class="px-5 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Views</th>
                        <th class="px-5 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Date</th>
                        <th class="px-5 py-4 text-right text-sm font-medium text-gray-500 dark:text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($articles as $article)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-4">
                                    @if($article->featured_image)
                                        <img src="{{ Storage::url($article->featured_image) }}"
                                             alt="{{ $article->title }}"
                                             class="h-12 w-16 rounded-lg object-cover">
                                    @else
                                        <div class="flex h-12 w-16 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800">
                                            <svg class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                                <path d="M21 15l-5-5L5 21"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-medium text-gray-800 dark:text-white/90">{{ Str::limit($article->title, 40) }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 rounded-full bg-brand-100 dark:bg-brand-900 flex items-center justify-center">
                                        <span class="text-xs font-medium text-brand-600 dark:text-brand-400">{{ substr($article->user->name ?? 'A', 0, 1) }}</span>
                                    </div>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $article->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $article->status_badge }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-700 dark:text-gray-300">
                                {{ number_format($article->views) }}
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-700 dark:text-gray-300">
                                {{ $article->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.articles.show', $article) }}"
                                       class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-300"
                                       title="View">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                       class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-brand-500 dark:hover:bg-gray-800"
                                       title="Edit">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this article?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded-lg p-2 text-gray-500 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-900/20"
                                                title="Delete">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                                                <path d="M10 11v6M14 11v6"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                        <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">No articles found</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Get started by creating your first article.</p>
                                    <a href="{{ route('admin.articles.create') }}"
                                       class="mt-4 inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 5v14M5 12h14"/>
                                        </svg>
                                        Create Article
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($articles->hasPages())
            <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                {{ $articles->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
