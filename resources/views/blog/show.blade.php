@extends('layouts.frontend')

@section('title', $article->title)
@section('meta_description', $article->meta_description ?? Str::limit($article->excerpt ?? strip_tags($article->content), 160))

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
                    <li class="bread-crumbs__item">
                        <a href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    <li class="bread-crumbs__item">{{ Str::limit($article->title, 40) }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- DETAIL MAIN BLOCK EOF -->

    <!-- BEGIN POST -->
    <div class="post">
        <div class="wrapper">
            {{-- Article Cover Image --}}
            @if($article->featured_image)
                <div class="post-cover" style="margin-bottom: 40px;">
                    <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" style="width: 100%; max-height: 600px; object-fit: cover; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                </div>
            @endif

            <div class="post-top">
                <h2>{{ $article->title }}</h2>
                @if($article->excerpt)
                    <p style="font-size: 18px; color: #666; line-height: 1.6; margin-bottom: 20px;">{{ $article->excerpt }}</p>
                @endif
                <ul class="post-top__info">
                    <li class="post-top__date"><i class="icon-date"></i>{{ $article->created_at->format('F d, Y') }}</li>
                    <li class="post-top__user"><i class="icon-user2"></i><a href="#">by {{ $article->author ?? 'Admin' }}</a></li>
                    <li class="post-top__watch"><i class="icon-eye"></i>{{ number_format($article->views) }}</li>
                </ul>
            </div>
            <div class="post-content" style="line-height: 1.8; font-size: 16px;">
                {!! $article->content !!}
            </div>
            <div class="post-bottom">
                <div class="post-bottom__info">
                    @if($article->tags)
                        <div class="post-bottom__tags">
                            <span>Tags:</span>
                            <ul>
                                @php
                                    $tags = is_array($article->tags) ? $article->tags : explode(',', $article->tags);
                                @endphp
                                @foreach($tags as $tag)
                                    <li><a href="#">{{ trim($tag) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="contacts-info__social">
                        <span>Share:</span>
                        <ul>
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"><i class="icon-facebook"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank"><i class="icon-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($article->title) }}" target="_blank"><i class="icon-in"></i></a></li>
                            <li><a href="https://wa.me/?text={{ urlencode($article->title . ' ' . request()->url()) }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="post-bottom__nav">
                    @if($previousArticle)
                        <a href="{{ route('blog.show', $previousArticle->slug) }}"><i class="icon-arrow"></i>Previous Post</a>
                    @else
                        <span></span>
                    @endif
                    @if($nextArticle)
                        <a href="{{ route('blog.show', $nextArticle->slug) }}">Next Post<i class="icon-arrow"></i></a>
                    @endif
                </div>
            </div>

            {{-- Related Articles --}}
            @if($relatedArticles->count() > 0)
                <div class="post-related" style="margin-top: 60px; padding-top: 40px; border-top: 1px solid #eee;">
                    <h3 style="font-size: 28px; margin-bottom: 30px; text-align: center;">Related Articles</h3>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                        @foreach($relatedArticles as $related)
                            <div class="blog-item">
                                <a href="{{ route('blog.show', $related->slug) }}" class="blog-item__img">
                                    @if($related->featured_image)
                                        <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?w=600&h=400&fit=crop" alt="{{ $related->title }}">
                                    @endif
                                    <span class="blog-item__date">
                                        <span>{{ $related->created_at->format('M') }}</span> {{ $related->created_at->format('d') }}
                                    </span>
                                </a>
                                <a href="{{ route('blog.show', $related->slug) }}" class="blog-item__title">{{ $related->title }}</a>
                                <p>{{ Str::limit($related->excerpt ?? strip_tags($related->content), 100) }}</p>
                                <a href="{{ route('blog.show', $related->slug) }}" class="blog-item__link">Read more <i class="icon-arrow-md"></i></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <img class="promo-video__decor js-img" data-src="{{ asset('frontend/img/promo-video__decor.jpg') }}"
            src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" alt="">
    </div>
    <!-- POST EOF -->

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
    .post-related .blog-item {
        margin-bottom: 0;
    }

    @media (max-width: 992px) {
        .post-related > div {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        .post-related > div {
            grid-template-columns: 1fr !important;
        }
    }

    /* Enhanced Content Styling for HTML from TinyMCE */
    .post-content h1, .post-content h2, .post-content h3,
    .post-content h4, .post-content h5, .post-content h6 {
        margin-top: 1.5em;
        margin-bottom: 0.75em;
        font-weight: 600;
        line-height: 1.3;
        color: #1a202c;
    }

    .post-content h1 { font-size: 2.25em; }
    .post-content h2 { font-size: 1.875em; }
    .post-content h3 { font-size: 1.5em; }
    .post-content h4 { font-size: 1.25em; }

    .post-content p {
        margin-bottom: 1.25em;
        line-height: 1.8;
    }

    .post-content ul, .post-content ol {
        margin: 1.25em 0;
        padding-left: 2em;
    }

    .post-content ul li, .post-content ol li {
        margin-bottom: 0.5em;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5em 0;
    }

    .post-content blockquote {
        border-left: 4px solid #0d5c47;
        padding-left: 1.5em;
        margin: 1.5em 0;
        font-style: italic;
        color: #555;
    }

    .post-content a {
        color: #0d5c47;
        text-decoration: underline;
    }

    .post-content a:hover {
        color: #094536;
    }

    .post-content pre {
        background: #f5f5f5;
        padding: 1em;
        border-radius: 8px;
        overflow-x: auto;
        margin: 1.5em 0;
    }

    .post-content code {
        background: #f5f5f5;
        padding: 0.2em 0.4em;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        font-size: 0.9em;
    }

    .post-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5em 0;
    }

    .post-content table th,
    .post-content table td {
        border: 1px solid #ddd;
        padding: 0.75em;
        text-align: left;
    }

    .post-content table th {
        background: #f5f5f5;
        font-weight: 600;
    }
</style>
@endpush
