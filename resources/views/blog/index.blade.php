@extends('layouts.frontend')

@section('title', 'Blog')
@section('meta_description', 'Latest articles and insights about beauty salon management and coaching')

@section('content')
    <!-- BEGIN DETAIL MAIN BLOCK -->
    <div class="detail-block detail-block_margin">
        <div class="wrapper">
            <div class="detail-block__content">
                <h1>Blog</h1>
                <ul class="bread-crumbs">
                    <li class="bread-crumbs__item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="bread-crumbs__item">Blog</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- DETAIL MAIN BLOCK EOF -->

    <!-- BEGIN BLOG -->
    <div class="blog">
        <div class="wrapper">
            @if($articles->count() > 0)
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
                            <p>{{ Str::limit($article->excerpt ?? strip_tags($article->content), 150) }}</p>
                            <a href="{{ route('blog.show', $article->slug) }}" class="blog-item__link">Read more <i class="icon-arrow-md"></i></a>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($articles->hasPages())
                    <ul class="paging-list">
                        @if($articles->onFirstPage())
                            <li class="paging-list__item paging-prev disabled">
                                <span class="paging-list__link"><i class="icon-arrow"></i></span>
                            </li>
                        @else
                            <li class="paging-list__item paging-prev">
                                <a href="{{ $articles->previousPageUrl() }}" class="paging-list__link"><i class="icon-arrow"></i></a>
                            </li>
                        @endif

                        @foreach($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                            <li class="paging-list__item {{ $page == $articles->currentPage() ? 'active' : '' }}">
                                <a href="{{ $url }}" class="paging-list__link">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if($articles->hasMorePages())
                            <li class="paging-list__item paging-next">
                                <a href="{{ $articles->nextPageUrl() }}" class="paging-list__link"><i class="icon-arrow"></i></a>
                            </li>
                        @else
                            <li class="paging-list__item paging-next disabled">
                                <span class="paging-list__link"><i class="icon-arrow"></i></span>
                            </li>
                        @endif
                    </ul>
                @endif
            @else
                <div style="text-align: center; padding: 80px 20px;">
                    <i class="fas fa-newspaper" style="font-size: 80px; color: #ddd; margin-bottom: 20px; display: block;"></i>
                    <h3 style="font-size: 24px; color: #333; margin-bottom: 10px;">No Articles Yet</h3>
                    <p style="color: #666;">Check back soon for our latest articles and insights.</p>
                </div>
            @endif
        </div>
        <img class="promo-video__decor js-img" data-src="{{ asset('frontend/img/promo-video__decor.jpg') }}"
            src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" alt="">
    </div>
    <!-- BLOG EOF -->

    <!-- BEGIN SUBSCRIBE -->
    <div class="subscribe">
        <div class="wrapper">
            <div class="subscribe-form">
                <div class="subscribe-form__img">
                    <img src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=300&h=300&fit=crop" alt="Newsletter">
                </div>
                <form action="#" method="POST">
                    @csrf
                    <h3>Stay in touch</h3>
                    <p>Subscribe to our newsletter for the latest updates and insights.</p>
                    <div class="box-field__row">
                        <div class="box-field">
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <button type="submit" class="btn">subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- SUBSCRIBE EOF -->

    <!-- BEGIN INSTA PHOTOS -->
    <div class="insta-photos">
        <a href="#" class="insta-photo">
            <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&h=400&fit=crop" alt="Instagram Photo 1">
            <div class="insta-photo__hover">
                <i class="icon-insta"></i>
            </div>
        </a>
        <a href="#" class="insta-photo">
            <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&h=400&fit=crop" alt="Instagram Photo 2">
            <div class="insta-photo__hover">
                <i class="icon-insta"></i>
            </div>
        </a>
        <a href="#" class="insta-photo">
            <img src="https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?w=400&h=400&fit=crop" alt="Instagram Photo 3">
            <div class="insta-photo__hover">
                <i class="icon-insta"></i>
            </div>
        </a>
        <a href="#" class="insta-photo">
            <img src="https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?w=400&h=400&fit=crop" alt="Instagram Photo 4">
            <div class="insta-photo__hover">
                <i class="icon-insta"></i>
            </div>
        </a>
        <a href="#" class="insta-photo">
            <img src="https://images.unsplash.com/photo-1598452963314-b09f397a5c48?w=400&h=400&fit=crop" alt="Instagram Photo 5">
            <div class="insta-photo__hover">
                <i class="icon-insta"></i>
            </div>
        </a>
        <a href="#" class="insta-photo">
            <img src="https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400&h=400&fit=crop" alt="Instagram Photo 6">
            <div class="insta-photo__hover">
                <i class="icon-insta"></i>
            </div>
        </a>
    </div>
    <!-- INSTA PHOTOS EOF -->
@endsection

@push('styles')
<style>
    .blog-items {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 60px;
        align-items: start;
        justify-items: center;
    }

    .blog-item {
        background: #fff;
        padding: 0;
        text-align: center;
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
        width: 100%;
        aspect-ratio: 2/1;
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
        .blog-items { grid-template-columns: 1fr !important; gap: 40px; }
    }

    @media (max-width: 768px) {
        .blog-items { grid-template-columns: 1fr !important; }
    }
</style>
@endpush
