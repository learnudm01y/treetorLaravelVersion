@extends('layouts.admin')

@section('title', $service->title)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endpush

@section('content')
    {{-- Page Header --}}
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.services.index') }}"
                   class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">{{ $service->title }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Service Details</p>
                </div>
            </div>
            <a href="{{ route('admin.services.edit', $service) }}"
               class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit Service
            </a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        {{-- Main Content --}}
        <div class="col-span-12 xl:col-span-8">
            {{-- Hero Section --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900 mb-6 overflow-hidden">
                @if($service->featured_image)
                    <img src="{{ Storage::url($service->featured_image) }}"
                         alt="{{ $service->title }}"
                         class="w-full h-64 object-cover">
                @endif
                <div class="p-6">
                    @if($service->badge)
                        <span class="inline-block px-3 py-1 text-xs font-medium text-brand-600 bg-brand-100 rounded-full mb-3 dark:bg-brand-900/20 dark:text-brand-400">
                            {{ $service->badge }}
                        </span>
                    @endif
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white/90 mb-2">{{ $service->title }}</h2>
                    @if($service->subtitle)
                        <p class="text-lg text-gray-600 dark:text-gray-400">{{ $service->subtitle }}</p>
                    @endif

                    @if($service->icon)
                        <div class="mt-4 flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-brand-100 dark:bg-brand-900/20 flex items-center justify-center">
                                <i class="{{ $service->icon }} text-2xl text-brand-500"></i>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $service->icon }}</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Overview --}}
            @if($service->overview)
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-4">
                        <i class="fas fa-file-alt text-brand-500 mr-2"></i>
                        Overview
                    </h3>
                    <div class="prose prose-gray dark:prose-invert max-w-none">
                        {!! nl2br(e($service->overview)) !!}
                    </div>
                </div>
            @endif

            {{-- Full Description --}}
            @if($service->content)
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-4">
                        <i class="fas fa-align-left text-brand-500 mr-2"></i>
                        Full Description
                    </h3>
                    <div class="prose prose-gray dark:prose-invert max-w-none">
                        {!! nl2br(e($service->content)) !!}
                    </div>
                </div>
            @endif

            {{-- Features --}}
            @if($service->features && count($service->features) > 0)
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-4">
                        <i class="fas fa-search text-brand-500 mr-2"></i>
                        Features
                    </h3>
                    <div class="space-y-4">
                        @foreach($service->features as $feature)
                            @if(!empty($feature['title']))
                                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg dark:bg-gray-800">
                                    <div class="w-10 h-10 rounded-lg bg-brand-100 dark:bg-brand-900/20 flex items-center justify-center flex-shrink-0">
                                        <i class="{{ $feature['icon'] ?? 'fas fa-check' }} text-brand-500"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800 dark:text-white/90">{{ $feature['title'] }}</h4>
                                        @if(!empty($feature['description']))
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $feature['description'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Benefits --}}
            @if($service->benefits && count($service->benefits) > 0)
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-4">
                        <i class="fas fa-star text-brand-500 mr-2"></i>
                        Benefits
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($service->benefits as $benefit)
                            @if(!empty($benefit['title']))
                                <div class="p-4 border border-gray-100 rounded-lg dark:border-gray-800">
                                    <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/20 flex items-center justify-center mb-3">
                                        <i class="{{ $benefit['icon'] ?? 'fas fa-star' }} text-green-500"></i>
                                    </div>
                                    <h4 class="font-medium text-gray-800 dark:text-white/90">{{ $benefit['title'] }}</h4>
                                    @if(!empty($benefit['description']))
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $benefit['description'] }}</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Ideal For --}}
            @if($service->ideal_for && count($service->ideal_for) > 0)
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-4">
                        <i class="fas fa-gem text-brand-500 mr-2"></i>
                        Ideal For
                    </h3>
                    <div class="space-y-3">
                        @foreach($service->ideal_for as $item)
                            @if(!empty($item['title']))
                                <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg dark:bg-gray-800">
                                    <i class="{{ $item['icon'] ?? 'fas fa-check-circle' }} text-green-500 mt-1"></i>
                                    <div>
                                        <h4 class="font-medium text-gray-800 dark:text-white/90">{{ $item['title'] }}</h4>
                                        @if(!empty($item['description']))
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $item['description'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="col-span-12 xl:col-span-4">
            {{-- Status & Info --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-4">Service Info</h3>

                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Status</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $service->status_badge }}">
                            {{ ucfirst($service->status) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Sort Order</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $service->sort_order }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Views</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ number_format($service->views) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Created</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $service->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Updated</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $service->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- Pricing --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-4">Pricing</h3>

                <div class="text-center py-4 border-b border-gray-200 dark:border-gray-800 mb-4">
                    <div class="text-3xl font-bold text-brand-500">{{ $service->formatted_price }}</div>
                    @if($service->price_note)
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $service->price_note }}</p>
                    @endif
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Price Type</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ ucfirst($service->price_type) }}</span>
                    </div>
                </div>
            </div>

            {{-- Contact --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 mb-6">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-4">Contact</h3>

                @if($service->whatsapp_number)
                    <div class="mb-4">
                        <span class="text-sm text-gray-500 dark:text-gray-400 block mb-1">WhatsApp</span>
                        <a href="https://wa.me/{{ $service->whatsapp_number }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 text-green-600 hover:text-green-700">
                            <i class="fab fa-whatsapp text-xl"></i>
                            +{{ $service->whatsapp_number }}
                        </a>
                    </div>
                @endif

                @if($service->cta_text)
                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 block mb-1">CTA Button Text</span>
                        <span class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $service->cta_text }}</span>
                    </div>
                @endif
            </div>

            {{-- SEO --}}
            @if($service->meta_description)
                <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-4">SEO</h3>

                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 block mb-1">Meta Description</span>
                        <p class="text-sm text-gray-800 dark:text-white/90">{{ $service->meta_description }}</p>
                        <span class="text-xs text-gray-400 mt-1">{{ strlen($service->meta_description) }} characters</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
