@extends('layouts.frontend')

@section('title', 'Home - Salon Coaching Excellence')
@section('meta_description', 'Empowering beauty salons with 14+ years of operational expertise')

@section('content')
<!-- BEGIN MAIN BLOCK -->
<div class="main-block-wrapper">
    <img class="main-block__decor" src="{{ asset('img/main-block-decor.png') }}" alt="">
    <div class="main-block load-bg js-main-slider">
        <!-- Slide 1 -->
        <div class="main-block__slide">
            <img class="main-block__bg" src="{{ asset('img/bacground.jpg') }}" alt="Background">
            <div class="wrapper">
                <div class="main-block__content">
                    <span class="saint-text">Welcome To</span>
                    <h1 class="main-text">Salon Coaching Excellence</h1>
                    <p>Empowering beauty salons with 14+ years of operational expertise. Transform your salon into a thriving business with our proven coaching methodologies.</p>
                    <a href="https://wa.me/971586658664" class="btn">Book Now</a>
                </div>
            </div>
            <div class="main-block__animated-image">
                <img src="{{ asset('img/back_logo.png') }}" alt="Company Logo">
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="main-block__slide">
            <img class="main-block__bg" src="{{ asset('img/info-item-bg1.jpg') }}" alt="Background">
            <div class="wrapper">
                <div class="main-block__content">
                    <span class="saint-text">Our Services</span>
                    <h1 class="main-text">Complete Salon Solutions</h1>
                    <p>From equipment optimization to staff training, branding to financial management - we provide comprehensive coaching services to elevate every aspect of your salon business.</p>
                    <a href="{{ route('services.index') }}" class="btn">Explore Our Services</a>
                </div>
            </div>
            <div class="main-block__animated-image">
                <img src="https://images.unsplash.com/photo-1633681926022-84c23e8cb2d6?w=600&h=600&fit=crop" alt="Salon Services">
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="main-block__slide">
            <img class="main-block__bg" src="{{ asset('img/info-item-bg2.jpg') }}" alt="Background">
            <div class="wrapper">
                <div class="main-block__content">
                    <span class="saint-text">Get in Touch</span>
                    <h1 class="main-text">Let's Work Together</h1>
                    <p>Ready to transform your salon? Contact us today for a consultation. We're here to answer your questions and help you achieve your business goals.</p>
                    <a href="{{ route('contact') }}" class="btn">Contact Us Now</a>
                </div>
            </div>
            <div class="main-block__animated-image">
                <img src="https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=600&h=600&fit=crop" alt="Contact Us">
            </div>
        </div>
    </div>
</div>
<!-- MAIN BLOCK EOF -->

<!-- BEGIN SPECIAL OFFER -->
<section class="special-offer">
    <div class="wrapper">
        <div class="special-offer__container">
            <div class="special-offer__item">
                <div class="special-offer__icon">🕐</div>
                <div class="special-offer__duration" style="font-style: italic !important;">1.5 Hours</div>
                <div class="special-offer__price-old" style="font-style: italic !important;">3 000 AED</div>
                <div class="special-offer__price-new" style="font-style: italic !important;">2 000 AED</div>
            </div>
            <div class="special-offer__separator"></div>
            <div class="special-offer__item">
                <div class="special-offer__icon">🕐</div>
                <div class="special-offer__duration" style="font-style: italic !important;">2.5 Hours</div>
                <div class="special-offer__price-old" style="font-style: italic !important;">5 000 AED</div>
                <div class="special-offer__price-new" style="font-style: italic !important;">2 500 AED</div>
            </div>
            <div class="special-offer__separator"></div>
            <div class="special-offer__item special-offer__item--cta">
                <a href="https://wa.me/971522243390" class="btn-book">Book Online</a>
                <p class="special-offer__note" style="font-style: italic !important;">When booking, mention that you are a new client and get the promotional price!</p>
            </div>
        </div>
    </div>
</section>
<!-- SPECIAL OFFER EOF -->

<!-- BEGIN ADVANTAGES -->
<div class="advantages">
    <div class="wrapper">
        <div class="trending-top">
            <span class="saint-text">Our Services</span>
            <h2>Core Service Pillars for Beauty Salons</h2>
            <p>Comprehensive coaching solutions designed to elevate every aspect of your salon business—from operations and branding to team development and financial success.</p>
        </div>
        <div class="advantages-items">
            <div class="advantages-item">
                <div class="advantages-item__icon">
                    <span class="icon-bg"></span>
                    <i class="fas fa-award" style="color: #90EE90 !important;"></i>
                </div>
                <h4>Equipment, Product & Procurement Optimization</h4>
                <p>Goal: Premium quality at optimized cost.</p>
            </div>
            <div class="advantages-item">
                <div class="advantages-item__icon">
                    <span class="icon-bg"></span>
                    <i class="fas fa-star" style="color: #90EE90 !important;"></i>
                </div>
                <h4>Service Menu & Pricing Strategy</h4>
                <p>Goal: Attract and retain clients while maximizing profits.</p>
            </div>
            <div class="advantages-item">
                <div class="advantages-item__icon">
                    <span class="icon-bg"></span>
                    <i class="far fa-heart" style="color: #90EE90 !important;"></i>
                </div>
                <h4>Branding & Interior Advisory</h4>
                <p>Goal: Build a brand clients love and a space that works.</p>
            </div>
            <div class="advantages-item">
                <div class="advantages-item__icon">
                    <span class="icon-bg"></span>
                    <i class="fas fa-seedling" style="color: #90EE90 !important;"></i>
                </div>
                <h4>Financial Oversight & Budget Optimization</h4>
                <p>Goal: Strengthen financial performance.</p>
            </div>
            <div class="advantages-item">
                <div class="advantages-item__icon">
                    <span class="icon-bg"></span>
                    <i class="far fa-user" style="color: #90EE90 !important;"></i>
                </div>
                <h4>HR Support & Talent Acquisition</h4>
                <p>Goal: Hire, train, and retain the right team.</p>
            </div>
            <div class="advantages-item">
                <div class="advantages-item__icon">
                    <span class="icon-bg"></span>
                    <i class="fas fa-phone-volume" style="color: #90EE90 !important;"></i>
                </div>
                <h4>Staff Training & Development</h4>
                <p>Goal: Equip your team with skills to deliver excellence.</p>
            </div>
            <div class="advantages-item">
                <div class="advantages-item__icon">
                    <span class="icon-bg"></span>
                    <i class="fas fa-clipboard" style="color: #90EE90 !important;"></i>
                </div>
                <h4>Operational Reporting & Team Goal Alignment</h4>
                <p>Goal: Drive accountability and continuous growth.</p>
            </div>
            <div class="advantages-item">
                <div class="advantages-item__icon">
                    <span class="icon-bg"></span>
                    <i class="fas fa-leaf" style="color: #90EE90 !important;"></i>
                </div>
                <h4>Business Structuring & Systemization</h4>
                <p>Goal: Build a salon that runs smoothly — with or without you.</p>
            </div>
        </div>
    </div>
</div>
<!-- ADVANTAGES EOF -->

<!-- BEGIN CLIENTS SLIDER -->
<div class="clients-slider-section">
    <div class="clients-slider js-clients-slider">
        <div class="client-slide">
            <img src="{{ asset('img/diamondSalons.jpg') }}" alt="Diamond Salons">
        </div>
        <div class="client-slide">
            <img src="{{ asset('img/55.png') }}" alt="Client Logo">
        </div>
        <div class="client-slide">
            <img src="{{ asset('img/44.png') }}" alt="Client Logo">
        </div>
        <div class="client-slide">
            <img src="{{ asset('img/33.png') }}" alt="Client Logo">
        </div>
        <div class="client-slide">
            <img src="{{ asset('img/22.png') }}" alt="Client Logo">
        </div>
        <div class="client-slide">
            <img src="{{ asset('img/11.png') }}" alt="Client Logo">
        </div>
        <div class="client-slide">
            <img src="{{ asset('img/diamondSalons.jpg') }}" alt="Diamond Salons">
        </div>
        <div class="client-slide">
            <img src="{{ asset('img/55.png') }}" alt="Client Logo">
        </div>
        <div class="client-slide">
            <img src="{{ asset('img/44.png') }}" alt="Client Logo">
        </div>
        <div class="client-slide">
            <img src="{{ asset('img/33.png') }}" alt="Client Logo">
        </div>
    </div>
</div>
<!-- CLIENTS SLIDER EOF -->

<!-- BEGIN INFO BLOCKS -->
<div class="info-blocks">
    <div class="info-blocks__item js-img" data-src="">
        <div class="wrapper">
            <div class="info-blocks__item-img">
                <img data-src="{{ asset('img/services.jpg') }}" src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" class="js-img" alt="">
            </div>
            <div class="info-blocks__item-text">
                <span class="saint-text">Professional Coaching</span>
                <h2>Complete Salon Management & Training</h2>
                <span class="info-blocks__item-descr">From branding and operations to staff training and financial management—we provide end-to-end coaching for beauty salons.</span>
                <p>Our comprehensive online coaching covers everything your salon needs: service menu optimization, team performance tracking, marketing strategies, customer experience enhancement, and financial oversight. We help you build a thriving salon with clear systems, trained staff, and sustainable growth.</p>
                <a href="{{ route('services.index') }}" class="btn">Explore now</a>
            </div>
        </div>
    </div>
    <div class="info-blocks__item info-blocks__item-reverse js-img" data-src="{{ asset('img/info-item-bg2.jpg') }}">
        <div class="wrapper">
            <div class="info-blocks__item-img">
                <img data-src="{{ asset('img/how we are.jpg') }}" src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" class="js-img" alt="Who We Are">
            </div>
            <div class="info-blocks__item-text">
                <span class="saint-text">About Us</span>
                <h2>Empowering Beauty Salons to Thrive</h2>
                <span class="info-blocks__item-descr">We specialize in transforming beauty salons through expert coaching, strategic planning, and hands-on support.</span>
                <p>With years of industry experience, we guide salon owners through every aspect of their business—from branding and operations to staff development and financial management. Our personalized coaching programs are designed to help you build a profitable, well-structured salon that delivers exceptional client experiences and sustainable growth.</p>
                <a href="{{ route('about') }}" class="btn">Learn more about us</a>
            </div>
        </div>
    </div>
</div>
<!-- INFO BLOCKS EOF -->

<!-- BEGIN LATEST NEWS -->
@if($latestArticles->count() > 0)
<section class="latest-news">
    <div class="wrapper">
        <div class="trending-top">
            <span class="saint-text">Our blog</span>
            <h2>The latest news at BeShop</h2>
            <p>Nourish your skin with toxin-free cosmetic products. With the offers that you can't refuse.</p>
        </div>
        <div class="blog-items">
            @foreach($latestArticles->take(2) as $article)
            <div class="blog-item">
                <a href="{{ route('blog.show', $article->slug) }}" class="blog-item__img">
                    @if($article->featured_image)
                        <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=600&h=400&fit=crop" alt="{{ $article->title }}">
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
        <div class="latest-news__btn">
            <a href="{{ route('blog.index') }}" class="btn">Read blog</a>
        </div>
    </div>
</section>
@endif
<!-- LATEST NEWS EOF -->

<!-- BEGIN SUBSCRIBE -->
<div class="subscribe">
    <div class="wrapper">
        <div class="subscribe-form">
            <div class="subscribe-form__img">
                <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=300&h=400&fit=crop" alt="Beauty Contact">
            </div>
            <form>
                <h3>Stay in touch</h3>
                <p>Nourish your skin with toxin-free cosmetic products.</p>
                <div class="box-field__row">
                    <div class="box-field">
                        <input type="email" class="form-control" placeholder="Enter your email">
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
