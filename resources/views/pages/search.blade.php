@extends('layouts.frontend')

@section('title', 'Search Results')
@section('meta_description', 'Search results for: ' . $query)

@section('content')
    <!-- BEGIN DETAIL MAIN BLOCK -->
    <div class="detail-block detail-block_margin">
        <div class="wrapper">
            <div class="detail-block__content">
                <h1>Search Results</h1>
                <ul class="bread-crumbs">
                    <li class="bread-crumbs__item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="bread-crumbs__item">Search</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- DETAIL MAIN BLOCK EOF -->

    <!-- BEGIN SEARCH RESULTS -->
    <section style="padding: 80px 0; min-height: 50vh;">
        <div class="wrapper">
            @if(strlen($query) < 2)
                <div style="text-align: center; padding: 60px 20px;">
                    <i class="fas fa-search" style="font-size: 80px; color: #ddd; margin-bottom: 20px; display: block;"></i>
                    <h3 style="font-size: 24px; color: #333; margin-bottom: 10px;">Enter a Search Term</h3>
                    <p style="color: #666;">Please enter at least 2 characters to search.</p>
                </div>
            @else
                <div style="margin-bottom: 40px;">
                    <h2 style="font-size: 28px; color: #2c2c2c;">
                        Search results for: <span style="color: #0d5c47;">"{{ $query }}"</span>
                    </h2>
                    <p style="color: #666; margin-top: 10px;">
                        Found {{ $services->count() }} service(s) and {{ $articles->count() }} article(s)
                    </p>
                </div>

                @if($services->count() == 0 && $articles->count() == 0)
                    <div style="text-align: center; padding: 60px 20px;">
                        <i class="fas fa-search" style="font-size: 80px; color: #ddd; margin-bottom: 20px; display: block;"></i>
                        <h3 style="font-size: 24px; color: #333; margin-bottom: 10px;">No Results Found</h3>
                        <p style="color: #666; margin-bottom: 30px;">We couldn't find anything matching "{{ $query }}". Try different keywords.</p>
                        <a href="{{ route('services.index') }}" class="btn">Browse Services</a>
                    </div>
                @else
                    {{-- Services Results --}}
                    @if($services->count() > 0)
                        <div style="margin-bottom: 60px;">
                            <h3 style="font-size: 22px; color: #2c2c2c; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #eee;">
                                <i class="fas fa-concierge-bell" style="color: #0d5c47; margin-right: 10px;"></i>
                                Services ({{ $services->count() }})
                            </h3>
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px;">
                                @foreach($services as $service)
                                    <a href="{{ route('services.show', $service->slug) }}" style="display: block; background: #fff; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.08); text-decoration: none; transition: all 0.3s ease;">
                                        <div style="height: 150px; background: linear-gradient(135deg, #0d5c47 0%, #094536 100%); display: flex; align-items: center; justify-content: center;">
                                            @if($service->featured_image)
                                                <img src="{{ Storage::url($service->featured_image) }}" alt="{{ $service->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <i class="{{ $service->icon ?? 'fas fa-concierge-bell' }}" style="font-size: 40px; color: rgba(255,255,255,0.3);"></i>
                                            @endif
                                        </div>
                                        <div style="padding: 20px;">
                                            @if($service->badge)
                                                <span style="display: inline-block; background: #e8f0ea; color: #0d5c47; padding: 4px 12px; border-radius: 15px; font-size: 11px; font-weight: 600; margin-bottom: 10px;">{{ $service->badge }}</span>
                                            @endif
                                            <h4 style="font-size: 17px; font-weight: 600; color: #2c2c2c; margin-bottom: 8px;">{{ $service->title }}</h4>
                                            <p style="color: #666; font-size: 14px; line-height: 1.5;">{{ Str::limit($service->subtitle ?? $service->overview, 80) }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Articles Results --}}
                    @if($articles->count() > 0)
                        <div>
                            <h3 style="font-size: 22px; color: #2c2c2c; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #eee;">
                                <i class="fas fa-newspaper" style="color: #0d5c47; margin-right: 10px;"></i>
                                Articles ({{ $articles->count() }})
                            </h3>
                            <div class="blog-items">
                                @foreach($articles as $article)
                                    <div class="blog-item">
                                        <a href="{{ route('blog.show', $article->slug) }}" class="blog-item__img">
                                            @if($article->featured_image)
                                                <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}">
                                            @else
                                                <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?w=600&h=400&fit=crop" alt="{{ $article->title }}">
                                            @endif
                                            <span class="blog-item__date">
                                                <span>{{ $article->created_at->format('M') }}</span> {{ $article->created_at->format('d') }}
                                            </span>
                                        </a>
                                        <a href="{{ route('blog.show', $article->slug) }}" class="blog-item__title">{{ $article->title }}</a>
                                        <p>{{ Str::limit($article->excerpt ?? strip_tags($article->content), 100) }}</p>
                                        <a href="{{ route('blog.show', $article->slug) }}" class="blog-item__link">Read more <i class="icon-arrow-md"></i></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        </div>
    </section>
    <!-- SEARCH RESULTS EOF -->
@endsection

@push('styles')
<style>
    .blog-items {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        align-items: start;
        justify-items: center;
    }

    .blog-item {
        background: #fff;
        padding: 0;
        text-align: center;
        max-width: 340px;
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(16,24,40,0.06);
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .blog-item__img {
        display: block;
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        height: 360px;
        margin: 0 auto;
        width: 100%;
        max-width: 340px;
    }

    .blog-item__img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        border-radius: 12px;
    }

    .blog-item__date {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 3;
    }

    .blog-item__title {
        display: block;
        font-size: 20px;
        line-height: 1.3;
        color: #222;
        margin: 0;
        padding: 18px 16px 8px;
        font-weight: 600;
        text-align: center;
    }

    .blog-item p {
        margin: 0;
        color: #666;
        text-align: center;
        padding: 0 16px 18px;
        font-size: 14px;
        line-height: 1.5;
    }

    .blog-item__link {
        color: #0d5c47;
        font-weight: 600;
        letter-spacing: 0.02em;
        text-decoration: none;
        display: inline-block;
        margin: 8px 0 18px;
    }

    .blog-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(16,24,40,0.08);
    }

    @media (max-width: 992px) {
        .blog-items { grid-template-columns: repeat(2, 1fr) !important; }
    }

    @media (max-width: 768px) {
        .blog-items { grid-template-columns: 1fr !important; }
        .blog-item__img { height: 260px; }
        .blog-item { max-width: 520px; }
    }
</style>
@endpush
