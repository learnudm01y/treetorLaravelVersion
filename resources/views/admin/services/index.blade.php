@extends('layouts.admin')

@section('title', 'Services')

@section('content')
    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">Services</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Manage your services</p>
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

    {{-- Toolbar --}}
    <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
        <form action="{{ route('admin.services.index') }}" method="GET" class="flex items-center gap-4">
            {{-- Search Input --}}
            <div class="relative inline-flex">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search services..."
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

            <div class="flex-1"></div>

            {{-- Add New Service Button --}}
            <a href="{{ route('admin.services.create') }}"
               class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 transition-colors whitespace-nowrap">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Add New Service
            </a>
        </form>
    </div>

    {{-- Services Table --}}
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-800">
                        <th class="px-5 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Service</th>
                        <th class="px-5 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Icon</th>
                        <th class="px-5 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Status</th>
                        <th class="px-5 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Price</th>
                        <th class="px-5 py-4 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Order</th>
                        <th class="px-5 py-4 text-right text-sm font-medium text-gray-500 dark:text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($services as $service)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-4">
                                    @if($service->featured_image)
                                        <img src="{{ Storage::url($service->featured_image) }}"
                                             alt="{{ $service->title }}"
                                             class="h-12 w-16 rounded-lg object-cover">
                                    @else
                                        <div class="flex h-12 w-16 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800">
                                            @if($service->icon)
                                                <i class="{{ $service->icon }} text-xl text-gray-400"></i>
                                            @else
                                                <svg class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                                </svg>
                                            @endif
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-medium text-gray-800 dark:text-white/90">{{ Str::limit($service->title, 40) }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($service->subtitle, 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                @if($service->icon)
                                    <div class="flex items-center gap-2">
                                        <i class="{{ $service->icon }} text-xl text-brand-500"></i>
                                        <span class="text-xs text-gray-500">{{ $service->icon }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $service->status_badge }}">
                                    {{ ucfirst($service->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90">
                                {{ $service->formatted_price }}
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90">
                                {{ $service->sort_order }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.services.show', $service) }}"
                                       class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-300"
                                       title="View">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service) }}"
                                       class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-300"
                                       title="Edit">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>
                                    <form id="delete-service-{{ $service->id }}"
                                          action="{{ route('admin.services.destroy', $service) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                onclick="confirmDeleteService({{ $service->id }}, '{{ addslashes($service->title) }}')"
                                                class="rounded-lg p-2 text-gray-500 hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-900/20"
                                                title="Delete">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
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
                                    <svg class="w-12 h-12 text-gray-300 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                        <path d="M2 17l10 5 10-5"/>
                                        <path d="M2 12l10 5 10-5"/>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-1">No services found</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Get started by creating your first service.</p>
                                    <a href="{{ route('admin.services.create') }}"
                                       class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 5v14M5 12h14"/>
                                        </svg>
                                        Add New Service
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($services->hasPages())
            <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                {{ $services->links() }}
            </div>
        @endif
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endpush

@push('scripts')
<script>
function confirmDeleteService(id, title) {
    Swal.fire({
        title: '⚠️ Delete Service?',
        html: `Are you sure you want to delete <strong>"${title}"</strong>?<br><small class="text-gray-500">This action cannot be undone.</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-service-' + id).submit();
        }
    });
}
</script>
@endpush
