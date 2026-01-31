@extends('layouts.frontend')

@section('title', 'Our Services')
@section('meta_description', 'Comprehensive salon coaching solutions - from branding to financial management')

@push('styles')
<style>
    * {
        box-sizing: border-box;
    }

    .services-hero {
        background: linear-gradient(135deg, #e8f0ea 0%, #d4e5d8 100%);
        padding: 180px 0 100px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .services-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="%230d5c47" opacity="0.1"/></svg>');
        opacity: 0.3;
    }

    .services-hero h1 {
        font-size: 56px;
        margin-bottom: 25px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        color: #2c2c2c;
        position: relative;
        z-index: 1;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
    }

    .services-hero p {
        font-size: 20px;
        max-width: 850px;
        margin: 0 auto;
        line-height: 1.8;
        color: #555;
        position: relative;
        z-index: 1;
    }

    .services-container {
        padding: 100px 0;
        background: #fff;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    @media (max-width: 1200px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }
    }

    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .services-hero h1 {
            font-size: 38px;
        }

        .services-hero p {
            font-size: 16px;
        }
    }

    .service-card-wrapper {
        width: 100%;
    }

    .service-card {
        display: flex;
        flex-direction: column;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        text-decoration: none;
        position: relative;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(13, 92, 71, 0.05) 0%, rgba(13, 92, 71, 0.02) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 1;
    }

    .service-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 60px rgba(13, 92, 71, 0.25);
    }

    .service-card:hover::before {
        opacity: 1;
    }

    .service-card__img-box {
        position: relative;
        height: 280px;
        overflow: hidden;
    }

    .service-card__img-box::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.4) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .service-card:hover .service-card__img-box::after {
        opacity: 1;
    }

    .service-card__img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .service-card:hover .service-card__img-box img {
        transform: scale(1.12);
    }

    .service-card__img-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #0d5c47 0%, #094536 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-card__img-placeholder i {
        font-size: 80px;
        color: rgba(255, 255, 255, 0.3);
    }

    .service-card__content {
        padding: 35px 30px;
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .service-card__badge {
        display: inline-block;
        background: linear-gradient(135deg, #0d5c47 0%, #094536 100%);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .service-card__title {
        font-size: 24px;
        font-weight: 700;
        color: #2c2c2c;
        margin-bottom: 18px;
        line-height: 1.3;
        transition: color 0.3s ease;
    }

    .service-card:hover .service-card__title {
        color: #0d5c47;
    }

    .service-card__meta {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .service-card__meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #888;
        font-size: 14px;
    }

    .service-card__meta-item i {
        color: #0d5c47;
        font-size: 16px;
    }

    .service-card__price {
        display: inline-block;
        background: linear-gradient(135deg, #0d5c47 0%, #094536 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 18px;
        box-shadow: 0 4px 15px rgba(13, 92, 71, 0.3);
    }

    .service-card__desc {
        color: #666;
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 25px;
        flex: 1;
    }

    .service-card__btn {
        margin-top: auto;
        padding-top: 10px;
    }

    .service-card__btn .btn {
        width: 100%;
        text-align: center;
        background: #fff;
        color: #e91e63;
        border: 2px solid #ffc1d9;
        padding: 0px 30px;
        font-size: 15px;
        font-weight: 600;
        border-radius: 30px;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .service-card:hover .service-card__btn .btn {
        background: linear-gradient(135deg, #ff9ec5 0%, #ffc1d9 100%);
        color: #fff;
        border-color: #ff9ec5;
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(233, 30, 99, 0.3);
    }

    .cta-section {
        background: linear-gradient(135deg, #0d5c47 0%, #094536 100%);
        color: white;
        padding: 100px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: movePattern 20s linear infinite;
    }

    @keyframes movePattern {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(50px, 50px);
        }
    }

    .cta-section h2 {
        font-size: 48px;
        margin-bottom: 25px;
        position: relative;
        z-index: 1;
        font-weight: 700;
        color: white !important;
    }

    .cta-section p {
        font-size: 20px;
        margin-bottom: 35px;
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.7;
        position: relative;
        z-index: 1;
        color: white !important;
    }

    .cta-section .btn {
        background: white;
        color: #0d5c47;
        padding: 0px 50px;
        font-size: 18px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.4s ease;
        border-radius: 35px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
        text-decoration: none;
        display: inline-block;
    }

    .cta-section .btn:hover {
        background: #f8f8f8;
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .no-services {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-services i {
        font-size: 80px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .no-services h3 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="services-hero">
        <div class="wrapper">
            <h1>Our Services</h1>
            <p>Comprehensive salon coaching solutions - from branding to financial management. Transform your beauty business with our expert consulting services.</p>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="services-container">
        @if($services->count() > 0)
            <div class="services-grid" style="justify-items: center;">
                @foreach($services as $service)
                    <div class="service-card-wrapper" style="max-width: 450px;">
                        <a href="{{ route('services.show', $service->slug) }}" class="service-card">
                            <div class="service-card__img-box">
                                @if($service->featured_image)
                                    <img src="{{ Storage::url($service->featured_image) }}" alt="{{ $service->title }}">
                                @else
                                    <div class="service-card__img-placeholder">
                                        <i class="{{ $service->icon ?? 'fas fa-concierge-bell' }}"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="service-card__content">
                                @if($service->badge)
                                    <span class="service-card__badge">{{ $service->badge }}</span>
                                @endif
                                <h3 class="service-card__title">{{ $service->title }}</h3>
                                <div class="service-card__meta">
                                    @if($service->icon)
                                        <div class="service-card__meta-item">
                                            <i class="{{ $service->icon }}"></i>
                                            {{ $service->badge ?? 'Professional Service' }}
                                        </div>
                                    @endif
                                </div>
                                @if($service->price_type !== 'contact')
                                    <div class="service-card__price">{{ $service->formatted_price }}</div>
                                @endif
                                <p class="service-card__desc">{{ Str::limit($service->subtitle ?? $service->overview, 150) }}</p>
                                <div class="service-card__btn">
                                    <span class="btn btn-sm">View Details</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($services->hasPages())
                <div class="wrapper" style="margin-top: 60px;">
                    <ul class="paging-list">
                        @if($services->onFirstPage())
                            <li class="paging-list__item paging-prev disabled">
                                <span class="paging-list__link"><i class="icon-arrow"></i></span>
                            </li>
                        @else
                            <li class="paging-list__item paging-prev">
                                <a href="{{ $services->previousPageUrl() }}" class="paging-list__link"><i class="icon-arrow"></i></a>
                            </li>
                        @endif

                        @foreach($services->getUrlRange(1, $services->lastPage()) as $page => $url)
                            <li class="paging-list__item {{ $page == $services->currentPage() ? 'active' : '' }}">
                                <a href="{{ $url }}" class="paging-list__link">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if($services->hasMorePages())
                            <li class="paging-list__item paging-next">
                                <a href="{{ $services->nextPageUrl() }}" class="paging-list__link"><i class="icon-arrow"></i></a>
                            </li>
                        @else
                            <li class="paging-list__item paging-next disabled">
                                <span class="paging-list__link"><i class="icon-arrow"></i></span>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
        @else
            <div class="no-services">
                <i class="fas fa-concierge-bell"></i>
                <h3>No Services Available</h3>
                <p>Check back soon for our upcoming services.</p>
            </div>
        @endif
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="wrapper">
            <h2>Ready to Transform Your Salon?</h2>
            <p>Get personalized coaching and take your beauty salon to the next level with our proven strategies and expert guidance.</p>
            <a href="https://wa.me/971586658664" class="btn"><i class="fab fa-whatsapp" style="margin-right: 10px;"></i>Contact Us on WhatsApp</a>
        </div>
    </div>
@endsection
